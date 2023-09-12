<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIndustries extends Model
{
    use HasFactory;
    protected $table = "masterindustries";
    protected $fillable = [
        'I_Id ',
        'Iname',
    ];

    public function companyjobpreferences()
    {
        return $this->hasMany(CompanyJobPreferences::class);
    }
}