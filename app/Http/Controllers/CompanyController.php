<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $company = new Company;

        $data = $company->paginate(10);

        return view('company',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'company' => ['required','max:255'],
            'email' => ['required'],
            'website' => ['required'],
            'logo' => ['required','max:3000','mimes:jpeg,bmp,png']
        ]);

        $path = $request->file('logo')->store('clogo');

        $company = new Company;

        $company->name = $request->input('company');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        // $company->logo = $request->logo->getClientOriginalName();
        $company->logo = $path;

        $company->save();

        return redirect('company');
    }

    public function show(Company $company)
    {
        return response()->json($company, 200);
    }

    public function edit(Company $company)
    {
        
    }

    public function update(Request $request, Company $company)
    {
        $c = new Company;

        if($request->input('email')){

            $c->where('id',$company->id)->update(['email'=>$request->input('email')]);
        }

        if($request->input('company')){

            $c->where('id',$company->id)->update(['name'=>$request->input('company')]);
        }

        if($request->input('website')){

            $c->where('id',$company->id)->update(['website'=>$request->input('website')]);
        }

        if($request->hasFile('logo')){

            $path = $request->file('logo')->store('clogo');

            $c->where('id',$company->id)->update(['logo'=>$path]);
        }
    }

    public function destroy(Company $company)
    {
        $c = new Company;

        $c->where('id',$company->id)->delete();
    }
}
