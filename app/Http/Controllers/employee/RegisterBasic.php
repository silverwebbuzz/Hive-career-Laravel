<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;


class RegisterBasic extends Controller
{
    //
    public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('employee.auth-register-basic', ['pageConfigs' => $pageConfigs]);
  }
  public function store(Request $request)
  {
    $validated = $request->validate([
        'EmployeeName' => 'required',
        'Email' => 'required|email:rfc,dns|unique:employee',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'Mobile' => 'required|numeric|max:10',
        'Gender' => 'required',
        'Resume' => 'required|mimes:doc,docx,pdf|max:6048',    
    ]);

    $employees = new Employee();
    $employees->EmployeeName  = $request->EmployeeName;
    $employees->Email  = $request->Email;
    $employees->Password  = $request->password;
    $employees->Mobile  = $request->Mobile;
    $employees->Gender  = $request->Gender;
    $employees->save();
    
  }
}
