<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function getEmployees($company)
    {
        try {
            // Retrieve employees by company_id from the route parameter
            $employees = Employee::select(['first_name', 'last_name', 'company_id', 'email', 'phone'])
                ->where('company_id', $company)  // $company comes from the route parameter
                ->get();
    
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
}
