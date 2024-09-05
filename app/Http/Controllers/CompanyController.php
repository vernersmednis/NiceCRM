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
        request()->validate([
            'logo' => ['required','min:3'],
            'name' => ['required', 'min:3'], 
            'email' => ['required', 'email'], 
        ]);

        // Update company attributes directly
        $company->update([
            'logo' => request('logo'),
            'name' => request('name'),
            'email' => request('email'),
        ]);

        // Redirect to companies list after successful update
        return redirect('/companies');
    }
}
