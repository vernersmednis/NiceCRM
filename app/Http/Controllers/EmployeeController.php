<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    // This function actually loads employees in batches per datatable.net page
    // (because, as you can see in resources/js/companies/show.js, the datatables config includes "serverSide: true")
    public function getEmployees($company)
    {
        try {
            // Retrieve employees by company_id from the route parameter
            $employees = Employee::select(['id', 'first_name', 'last_name', 'company_id', 'email', 'phone'])
                ->where('company_id', $company);  // $company comes from the route parameter
    
            // Return the data formatted for DataTables
            return DataTables::of($employees)
                ->addIndexColumn() // Optional: Adds an index column in DataTables
                ->toJson(); // Return as JSON for DataTables
    
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('DataTables Error: ' . $e->getMessage());
    
            // Return an error response in JSON format
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
    
        // Update employee attributes
        $employee->update([
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
        // Validate the input (already done automatically via Form Request)
        $validatedData = $request->validated();

        // Create a new employee
        Employee::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'company_id' => $validatedData['company_id'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);
    
        // Redirect to employees list of the company after successful creation
        return redirect()->route('companies.show', ['company' => $validatedData['company_id']]);
    }
    public function destroy($id)
    {
        // Delete the company from the database (if it exists)
        $employee = Employee::findOrFail($id);
        $employee->delete();

        // Return a JSON response
        return response()->json(['success' => 'Employee deleted successfully']);
    }
    public function create(CreateEmployeeRequest $request)
    {
        $company_id = $request->validated()['company_id'];
        // Pass the company_id to the view
        return view('employees.create', compact('company_id'));
    }
}
