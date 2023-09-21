<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Companies extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $table = "companies";
    protected $primaryKey = 'Com_Id';

    
    protected $fillable = [
        'Com_Id',
        'CompanyName',
        'Email',
        'EmailVerify',
        'CAffiliateCode',
        'EmailVerifyOtp',
        'token',
        'Password',
        'status',
    ];
    protected $hidden = [
        'password',
        'token',
        'remember_token',
    ];
    // protected $casts = [
    //     'EmailVerify' => '',
    // ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function companyjobpreferences()
    {
        return $this->hasMany(CompanyJobPreferences::class);
    }
    public function companiespakage()
    {
        return $this->hasMany(CompaniesPakage::class);
    }
    
}