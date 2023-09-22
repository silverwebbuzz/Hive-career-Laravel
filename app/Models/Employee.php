<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $primaryKey = 'Emp_Id';
    protected $fillable = [
        'Emp_Id ',
        'EmployeeName',
        'EmployeeImage',
        'Email',
        'Password',
        'Phone',
        'Mobile',
        'Gender',
        'MaritalStatus',
        'DoB',
        'Address',
        'City',
        'State',
        'Country',
        'CastCategory',
        'Passport',
        'MobileVerify',
        'EmailVerify',
        'EAffiliateCode',
        'FromEAff',
        'FromCAff',
        'sms_notify',
        'email_notify',
        'whatsapp_nofity',
        'linkedin',
        'twritter',
        'google',
        'facebook',
        'total_exp_year',
        'total_exp_month',
        'current_job_location',
        'profile_percentage',
        'exp_status',
        'status',
        'create_date',
    ];
}
