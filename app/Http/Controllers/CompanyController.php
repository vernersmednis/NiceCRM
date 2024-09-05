<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all(); // Fetch all companies from the database
        return view('companies.index', compact('companies'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    public function update(Company $company)
    {
        // Validating input
        $validatedData = request()->validate([
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255', 'unique:companies,name,'.$company->id], 
            'email' => ['required', 'email', 'unique:companies,email,'.$company->id], 
        ]);
    
        // Determine the logo path
        $logoPath = request()->hasFile('logo')
            ? request()->file('logo')->store('public/logos')
            : $company->logo;
    
        // If storing in public directory, you may need to strip the 'public/' part
        $logoPath = str_replace('public/', '', $logoPath);
    
        // Update company attributes
        $company->update([
            'logo' => $logoPath,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    
        // Redirect to companies list after successful update
        return redirect('/companies');
    }
}
