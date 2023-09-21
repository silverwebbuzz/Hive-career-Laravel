<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Traits\ResponseFormat;
use App\Models\EmployeeWorkExeperience;
use Hash;

class RegisterBasic extends Controller{
  use ResponseFormat;
  public function index(){
    $pageConfigs = ['myLayout' => 'blank'];
    return view('employee.auth-register-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function GenerateRefferCode($EmployeeDetail){
    if(!empty($EmployeeDetail)){
        $reffercode = 'E'.strtoupper(substr($EmployeeDetail->EmployeeName,0,5));
        return  
            (strlen($EmployeeDetail->Emp_Id) > 1) ? ($reffercode.$EmployeeDetail->Emp_Id) : $reffercode.'0'.$EmployeeDetail->Emp_Id;
    }
    return '';
  }
  public function store(Request $request){
    // $validated = $request->validate([
    //     'EmployeeName' => 'required',
    //     'Email' => 'required|email:rfc,dns|unique:employee',
    //     'password' => 'required|confirmed',
    //     'password_confirmation' => 'required|min:6',
    //     'Mobile' => 'required|numeric|digits:10',
    //     'Gender' => 'required',
    //    // 'Resume' => 'required|mimes:doc,docx,pdf|max:6048',    
    // ]);
    echo "<pre>";print_r($request->all());die;
    
    return redirect('employee/register#Employee-info');
    //return redirect(Request::url('employee/register#Employee-info'));
    //return view('employee.auth-register-basic#Employee-info');
    // return redirect()->action([employee::class, 'index#Employee-info']);
  }

  public function BasicDetails(Request $request){
    $RequestData = $request->all();        
    $AllValue =  array();
    parse_str($RequestData['formdata'], $AllValue);
    $employee = Employee::where('email',$AllValue['Email'])->first();
    if(empty($employee)){
      $employee = new Employee();
      $employee->EmployeeName  = $AllValue['employeename'];
      $employee->Email = $AllValue['Email'];
      $employee->password = Hash::make($AllValue['password']);
      $employee->Mobile = $AllValue['mobile'];
      $employee->Gender = $AllValue['Gender'];
      $employee->save();
      if($employee){
        $employee->EAffiliateCode = self::GenerateRefferCode($employee);
        $employee->save();
        return  $this->sendResponse('Employee Register...');
      }
    }else{
      $employee->EmployeeName  = $AllValue['employeename'];
      $employee->Email = $AllValue['Email'];
      $employee->password = Hash::make($AllValue['password']);
      $employee->Mobile = $AllValue['mobile'];
      $employee->Gender = $AllValue['Gender'];
      $employee->exp_status = $AllValue['type'];
      if($employee->exp_status == "experience"){
        $employee->total_exp_year = $AllValue['expYear'];
        $employee->total_exp_month = $AllValue['expmonth'];
      }
      $employee->City = $AllValue['expmonth'];
      $employee->save();
      return  $this->sendResponse('Employee Profession Data...');
    } 
  }

  public function Experience(Request $request){
    $RequestData = $request->all();        
    $AllValue =  array();
    parse_str($RequestData['formdata'], $AllValue);
    $employee = Employee::where('email',$AllValue['Email'])->first();
    if(!empty($employee)){
      $experience = new EmployeeWorkExeperience();
      $experience->Emp_Id = $employee->Emp_Id;
      $experience->Designation = $AllValue['Designation'];
      $experience->Company = $AllValue['Company']; 
      $experience->SalaryMode = 'Annually';
      $experience->start_year = $AllValue['start_year'];
      $experience->start_month = $AllValue['start_month'];
      $experience->end_year = $AllValue['end_year'];
      $experience->end_month = $AllValue['end_month'];
      $experience->YearlySal = $AllValue['YearlySal'];
      $experience->save();
      return  $this->sendResponse('Employee Experience Data...');
    }
  }
}
