<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $emp = new Employee;

        $data = $emp->all();

        $c = new Company;

        $com = $c->all();

        return view('employee',compact('data','com'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'fn' => ['required','max:255'],
            'ln' => ['required','max:255'],
            'email' => ['required'],
            'phone' => ['required','numeric'],
            'company' => ['required']
        ]);

        $employee = new Employee;

        $employee->first_name = $request->input('fn');
        $employee->last_name = $request->input('ln');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->company_id = $request->input('company');

        $employee->save();

        return redirect('employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $em = new Employee;

        if($request->input('email')){

            $em->where('id',$employee->id)->update(['email'=>$request->input('email')]);
        }

        if($request->input('company')){

            $em->where('id',$employee->id)->update(['company_id'=>$request->input('company')]);
        }

        if($request->input('fn')){

            $em->where('id',$employee->id)->update(['first_name'=>$request->input('fn')]);
        }

        if($request->input('ln')){

            $em->where('id',$employee->id)->update(['last_name'=>$request->input('ln')]);
        }

        if($request->input('phone')){

            $em->where('id',$employee->id)->update(['phone'=>$request->input('phone')]);
        }
    }

    public function destroy(Employee $employee)
    {
        $emp = new Employee;

        $emp->where('id',$employee->id)->delete();
    }
}
