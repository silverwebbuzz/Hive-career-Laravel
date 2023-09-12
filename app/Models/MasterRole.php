<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    use HasFactory;
    protected $table = "masterroles";
    protected $fillable = [
        'R_Id',
        'Rname	',
        'CompanyImagestatus',
    ];
    public function companyjobpreferences()
    {
        return $this->hasMany(CompanyJobPreferences::class);
    }
}