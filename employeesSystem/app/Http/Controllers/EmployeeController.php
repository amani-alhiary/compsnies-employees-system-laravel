<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    //
    public function index()
    {
         $companies = Company::orderBy('id','desc')->paginate(100);

        return view('dashboard.employee.create', compact('companies'));
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => 'required',
            // 'company_id' => 'required',
            // 'phone' => 'required',
        ]);
        // |min:100x100
        $input = $request->all();

   

        Employee::create($input);

        return redirect()->route('employeeslist.index')
            ->with('success', 'Employee created successfully.');
    }
    public function edit(Request $request)
    {
 
      

        $employee=DB::table('employees')
        ->select('*')
        ->where('id','=',$request['id'])
        ->get();
       
        $employee=$employee[0];

        $company=DB::table('companies')
        ->select('*')
        ->where('id','=',$employee->id)
        ->get();

        // dd($company);
        $company=$company[0];

        $companies = Company::orderBy('id','desc')->paginate(100);

        return view('dashboard.employee.edit',compact('employee','company','companies'));
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            

        ]);
        $input = $request->all();

   
        $employee->fill($input)->save();
  
        return redirect()->route('employeeslist.index')
        ->with('success', 'Employee updated successfully.');   
     }

          /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employeeslist.index')->with('success','Employee has been deleted successfully');
    }
}
