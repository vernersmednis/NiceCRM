<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    protected function handleLogoUpload($request, $currentLogo = null)
    {
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos');
            return str_replace('public/', '', $logoPath); // Clean up the path if needed
        }

        // If no new logo is uploaded, return the current logo
        return $currentLogo;
    }

    public function index()
    {
        $companies = Company::all(); // Fetch all companies from the database
        return view('companies.index', compact('companies'));
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
        Company::create([
            'logo' => $logoPath,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    
        // Redirect to companies list after successful creation
        return redirect('/companies');
    }
    public function destroy($id)
    {
        // Delete the company from the database (if it exists)
        $company = Company::findOrFail($id);
        $company->delete();

        // Return a JSON response
        return response()->json(['success' => 'Company deleted successfully']);
    }


    public function create()
    {
        return view('companies.create');
    }
}
