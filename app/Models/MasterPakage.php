<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPakage extends Model
{
    use HasFactory;
    protected $table = "masterpakages";
    protected $primaryKey = 'P_Id';
    protected $fillable = [
        'P_Id',
        'PDesc',
    ];
    public function companiespakage()
    {
        return $this->hasMany(CompaniesPakage::class);
    }
}