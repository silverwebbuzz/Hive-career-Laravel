<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Companies;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use Illuminate\Support\Str;
use Hash;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::get();
        return view('content.pages.pages-profile-user',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProfile()
    {
        // $companies = Companies::find($id);
        return view('content.authentications.auth-edit-register-basic');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $token = Str::random(64); 
        $otp = rand(1000,9999);
        $companies = Companies::find($id);
        $companies->CompanyName = $request-> companyname ;
        // $companies->CompanyImage = $request-> companyimage ;
        $companies->Email = $request-> email ;
        $companies->Website = $request-> website ;
        $companies->Phone = $request-> phone ;
        $companies->Mobile = $request-> mobile ;
        $companies->ContactName = $request-> contactname ;
        $companies->Address = $request-> address ;
        $companies->City = $request-> city ;
        $companies->State = $request-> state ;
        $companies->Country = $request-> country ;
        $companies->GSTIN = $request-> gstin ;
        $companies->PAN = $request-> pan ;
        $companies->IdentityProof = $request-> identityproof ;
        // $companies->token = $token; 
        // $companies->EmailVerifyOtp = $otp;
        $companies->save();
        return view('content.authentications.pages-profile-user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}