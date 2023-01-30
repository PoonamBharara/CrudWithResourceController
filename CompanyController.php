<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::orderBy('id', 'desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }

    public function create(){
        return view('companies.create');
    }

    public function store(Request $request, Company $company){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        // dd($request->post());

        $company->fill($request->post())->save();
        return redirect()->route('companies.index')->with('success', 'Company has been updated');
    }


    public function edit(Company $company){
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $company->fill($request->post())->save();
        return redirect()->route('companies.index')->with('Success', 'Company has been Updated');
    }

    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company has been deleted');
    }
}
