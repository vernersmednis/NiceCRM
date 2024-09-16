<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getEmployeesByCompany($companyId)
    {
        // Retrieve employees by company_id
        return Employee::select(['id', 'first_name', 'last_name', 'company_id', 'email', 'phone'])
            ->where('company_id', $companyId);
    }

    public function createEmployee(array $data)
    {
        // Create a new employee record in the database
        return Employee::create($data);
    }

    public function updateEmployee(Employee $employee, array $data)
    {
        // Update an existing employee record
        $employee->update($data);
    }

    public function deleteEmployee($id)
    {
        // Delete an employee record by ID
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }
}
