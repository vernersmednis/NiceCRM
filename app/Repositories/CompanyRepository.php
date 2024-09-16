<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyRepository
{
    public function getCompaniesForDataTable()
    {
        // Fetch the companies to be used in DataTables
        return Company::select(['id', 'name', 'email', 'logo']);
    }

    public function createCompany(array $data)
    {
        // Create a new company record in the database
        return Company::create($data);
    }

    public function updateCompany(Company $company, array $data)
    {
        // Update an existing company record
        $company->update($data);
    }

    public function deleteCompany($id)
    {
        // Delete a company record by ID
        $company = Company::findOrFail($id);
        $company->delete();
    }

    public function findCompanyById($id)
    {
        // Find a company by its ID
        return Company::findOrFail($id);
    }
}
