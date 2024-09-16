<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Mail\CompanyCreatedMail;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    protected $companyRepo;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    protected function handleLogoUpload($request, $currentLogo = null)
    {
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos');
            return str_replace('public/', '', $logoPath);
        } else {
            return $currentLogo;
        }
    }

    public function getCompanies(Request $request)
    {
        try {
            // Use the repository to get the companies for DataTables
            $companies = $this->companyRepo->getCompaniesForDataTable();
    
            // Return the data in the required DataTables format
            return DataTables::of($companies)
                ->addIndexColumn()
                ->toJson();
    
        } catch (\Exception $e) {
            \Log::error('DataTables Error: ' . $e->getMessage());
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
        $validatedData = $request->validated();
        $logoPath = $this->handleLogoUpload($request, $company->logo);

        // Use the repository to update the company
        $this->companyRepo->updateCompany($company, [
            'logo' => $logoPath,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    public function store(StoreCompanyRequest $request)
    {
        $validatedData = $request->validated();
        $logoPath = $this->handleLogoUpload($request);

        // Use the repository to create a new company
        $company = $this->companyRepo->createCompany([
            'logo' => $logoPath,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        Mail::to($company->email)->send(new CompanyCreatedMail($company));

        return redirect()->route('companies.index');
    }

    public function destroy($id)
    {
        // Use the repository to delete the company
        $this->companyRepo->deleteCompany($id);

        return response()->json(['success' => 'Company deleted successfully']);
    }

    public function create()
    {
        return view('companies.create');
    }
}
