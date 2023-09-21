<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeJobPreferences extends Model
{
    use HasFactory;
    protected $table = "employeeworkexperience";
    protected $primaryKey = "EWE_Id";
    protected $fillable = [
        'EWE_Id',
        'Emp_Id',
        'Company',
        'Designation',
        'Current',
        'SalaryMode',
        'Currency',
        'YearlySal',
        'HideMySal',
        'start_year',
        'start_month',
        'end_year',
        'end_month',
    ]; 
}
