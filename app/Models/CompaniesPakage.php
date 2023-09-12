<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesPakage extends Model
{
    use HasFactory;
    protected $table = "companiespakages";
    protected $primaryKey = 'CP_Id';
    protected $fillable = [
        'CP_Id	',
        'Com_Id',
        'PName',
        'P_Id',
    ];
    public function companies()
    {
        return $this->belongsTo(Companies::class,'Com_Id','Com_Id');
    }
    public function masterpakage()
    {
        return $this->belongsTo(MasterPakage::class, 'P_Id','P_Id');
    }
    
}