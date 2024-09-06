<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{

    public function getEmployees(Request $request)
    {
        try {
            // Select the necessary columns from the employees table
            $companies = Employee::select(['first_name', 'last_name', 'company_id', 'email', 'phone']);
    
            // Return the data in the required DataTables format
            return DataTables::of($companies)
                ->addIndexColumn() // Add an index column (optional)
                ->toJson(); // Ensure the response is JSON
    
        } catch (\Exception $e) {
            // Log error to help with debugging
            \Log::error('DataTables Error: ' . $e->getMessage());
    
            // Return error response (optional)
            return response()->json(['error' => 'An error occurred while fetching the data'], 500);
        }
    }
}
