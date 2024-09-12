<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Mail\CompanyCreatedMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{

    protected function handleLogoUpload($request, $currentLogo = null)
    {
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos');
            return str_replace('public/', '', $logoPath); // Clean up the path if needed
        } else {
            // If no new logo is uploaded, return the current logo
            return $currentLogo;
        }
    }

    // This function actually loads companies in batches per datatable.net page
    // (because, as you can see in resources/js/companies/index.js, the datatables config includes "serverSide: true")
    public function getCompanies(Request $request)
    {
        try {
            // Select the necessary columns from the companies table
            $companies = Company::select(['id', 'name', 'email', 'logo']);
    
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

    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company]);
    }

    public function index()
    {
        return view('companies.index');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // Get validated data from the request
        $validatedData = $request->validated();
    
        // Determine the logo path
        $logoPath = $this->handleLogoUpload($request, $company->logo);
    
        // Update company attributes
        $company->update([
            'logo' => $logoPath,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    
        // Redirect to companies list after successful update
        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    public function store(StoreCompanyRequest $request)
    {
        // Validate the input (already done automatically via Form Request)
        $validatedData = $request->validated();
    
        // Handle the logo upload
        $logoPath = $this->handleLogoUpload($request);

        // Create a new company
        $company = Company::create([
            'logo' => $logoPath,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    
        
        Mail::to($company->email)->send(
            new CompanyCreatedMail($company)
        );

        // Redirect to companies list after successful creation
        return redirect()->route('companies.index');
    }
    public function destroy($id)
    {
        // Delete the company from the database (if it exists)
        $company = Company::findOrFail($id);
        $company->delete();

        // Return a JSON response
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }


    public function create()
    {
        return view('companies.create');
    }
}
