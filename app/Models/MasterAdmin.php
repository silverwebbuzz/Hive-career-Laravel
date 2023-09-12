<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class MasterAdmin extends Authenticatable implements AuthenticatableContract{
    use HasFactory;

    // protected $table = "masteradmin";
    protected $table = "companies";
    // protected $password = 'Password';

    protected $fillable = [
        'A_id',
        'email',
        'password',
        'status',
        'create_date'
    ];
}