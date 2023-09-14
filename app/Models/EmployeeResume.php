<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResume extends Model
{
    use HasFactory;
    protected $table = 'employeeresumes';
    protected $fillable = [
        'Emp_Id',
        'ResumeFile',
        'ResumePath',
        'ResumeText',
    ];
}
