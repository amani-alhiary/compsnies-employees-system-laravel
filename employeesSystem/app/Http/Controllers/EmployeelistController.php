<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EmployeelistController extends Controller
{
    public function index()
    {
        //  $employees = Employee::orderBy('id','desc')->paginate(100);

         $employees=DB::table('employees')
        ->select('employees.id','employees.first_name','employees.last_name','employees.email','employees.phone','employees.company_id','companies.name')
        ->join('companies','companies.id','=','employees.company_id')
        ->paginate(10);

        // $employees=$employees[0];
        // dd($employees);
        return view('dashboard.employee.index', compact('employees'));
    }
}
