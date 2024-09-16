<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepo;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function getEmployees($company)
    {
        try {
            // Use the repository to get employees by company_id
            $employees = $this->employeeRepo->getEmployeesByCompany($company);
    
            // Return the data formatted for DataTables
            return DataTables::of($employees)
                ->addIndexColumn()
                ->toJson();
    
        } catch (\Exception $e) {
            \Log::error('DataTables Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching the data'], 500);
        }
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee' => $employee]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // Get validated data from the request
        $validatedData = $request->validated();

        // Use the repository to update the employee
        $this->employeeRepo->updateEmployee($employee, [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Redirect to employees list of the company after successful update
        return redirect()->route('companies.show', ['company' => $employee->company_id]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        // Get validated data from the request
        $validatedData = $request->validated();

        // Use the repository to create a new employee
        $this->employeeRepo->createEmployee([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'company_id' => $validatedData['company_id'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Redirect to employees list of the company after successful creation
        return redirect()->route('companies.show', ['company' => $validatedData['company_id']]);
    }

    public function destroy($id, Request $request)
    {
        // Use the repository to delete the employee
        $this->employeeRepo->deleteEmployee($id);
        
        return response()->json(['success' => 'Employee deleted successfully']);
    }

    public function create(CreateEmployeeRequest $request)
    {
        $company_id = $request->validated()['company_id'];
        // Pass the company_id to the view
        return view('employees.create', compact('company_id'));
    }
}
