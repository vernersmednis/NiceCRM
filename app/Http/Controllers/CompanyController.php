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
}
