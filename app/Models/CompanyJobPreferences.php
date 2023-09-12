<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyJobPreferences extends Model
{
    use HasFactory;
    protected $table = "companyjobpreferences";
    protected $primaryKey = 'CJP_Id';
    protected $fillable = [
        'CJP_Id	',
        'Com_Id',
        'I_Id',
        'C_Id',
        'R_Id',
        'EmploymentType',
        'JobType',
    ];
    public function companies()
    {
        return $this->belongsTo(Companies::class,'Com_Id','Com_Id');
    }
    public function masterindustries()
    {
        return $this->belongsTo(MasterIndustries::class,'I_Id','I_Id');
    }
    public function masterjobcategory()
    {
        return $this->belongsTo(MasterJobCategory::class,'C_Id','C_Id');
    }
    public function masterroles()
    {
        return $this->belongsTo(MasterRole::class,'R_Id','R_Id');
    }
}