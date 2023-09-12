<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJobCategory extends Model
{
    use HasFactory;
    protected $table = "masterjobcategory";
    protected $fillable = [
        'C_Id',
        'I_Id',
        'Cname',
    ];

    public function companyjobpreferences()
    {
        return $this->hasMany(CompanyJobPreferences::class);
    }
}