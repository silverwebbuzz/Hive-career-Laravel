<?php

namespace App\Http\Controllers\projects;
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
class AdminController extends Controller
{

    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
    } 
    
    public function customLogin(Request $request)
    {   

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only(['email', 'password']);
        $credentials['EmailVerify'] = '1';
       
        if (Auth::attempt($credentials) ) {
            return redirect()->route('dashboard-analytics')
                        ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('companypakage.list');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    public function customRegistration(Request $request)
    {
    $request->validate([
    'companyname' => 'required',
    'email' => 'required|email|unique:companies',
    'password' => 'required',
    // 'companyimage' => 'required',
    // 'website' => 'required',
    // 'phone' => 'required',
    // 'mobile' => 'required',
    // 'contactname' => 'required',
    // 'address' => 'required',
    // 'city' => 'required',
    // 'state' => 'required',
    // 'country' => 'required',
    // 'gstin' => 'required',
    // 'pan' => 'required',
    // 'identityproof' => 'required',
    // 'caffiliateCode' => 'required',
    // 'fromcaff' => 'required',
    // 'fromeaff' => 'required',
    // 'companylinkedin' => 'required',
    // 'companytwitter' => 'required',
    // 'companygoogle' => 'required',
    // 'companyfacebook' => 'required',
    // 'companystatus' => 'required',
    ]);
    //Email Verify
    $token = Str::random(64); 
    $otp = rand(1000,9999);
    
    $companies = new Companies();
    $companies->CompanyName = $request-> companyname ;
    // $companies->CompanyImage = $request-> companyimage ;
    $companies->Email = $request-> email ;
    $companies->password = Hash::make($request->input('password'));
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
    $companies->CAffiliateCode = $request-> caffiliateCode ;
    $companies->FromCAff = $request-> fromcaff ;
    $companies->FromEAff = $request-> fromeaff ;
    $companies->token = $token; 
    $companies->EmailVerifyOtp = $otp;
    $companies->save();
    $details = [
        'email' => $companies->Email,
        'otp' => $companies->EmailVerifyOtp,
    ];
    Mail::to($companies->Email)->send(new \App\Mail\otpregistermail($details));
    Mail::to("parthshingala321@gmail.com")->send(new \App\Mail\adminverifyemail($details));
   
    // Mail::send('emails.emailverificationmail', ['token' => $token], function($message) use($request){
    //     $message->to($request->email);
    //     $message->subject('Email Verification Mail');
    // });
    
    // return redirect()->route('login');

    return redirect()->route("emailVerifyOtp".$companies->id);
    }

    public function emailVerifyOtp()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-verify-email-otp-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function thankyou()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-thankyou-basic', ['pageConfigs' => $pageConfigs]);
    }
    
 
    public function emailVerifyLogin(Request $request)
    {   
        $userEnteredOtp = $request->input('otp');
        $storedotp = Companies::select('EmailVerifyOtp','EmailVerify', 'Com_Id')->where('EmailVerifyOtp',$userEnteredOtp)->first();
        $companies = Companies::find($storedotp->Com_Id);
        if(!empty($storedotp))
        {            
            if ($storedotp->EmailVerifyOtp == $userEnteredOtp )
            {
                if (!is_null($storedotp)) 
                {
                    if ($storedotp->EmailVerify == 0) 
                    { 
                        $companies->EmailVerify = '1';
                        $companies->save();

                        return redirect()->route('thankyou');
                    } 
                } else {
                    return redirect()->route('emailVerifyOtp');
                }
            }else{
                return redirect()->route('emailVerifyOtp');
            }
        }
        return redirect()->route('emailVerifyOtp');
    }
    
   
    public function verifyAccount($token)
    {   
        $verifyUser = Companies::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        
       
        if(!is_null($verifyUser) ){
            if($verifyUser->EmailVerify == 0) {                
                $verifyUser->EmailVerify = '1';                
                $verifyUser->save();                         
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('login')->with('message', $message);
    }

    public function signOut() 
    {
        Session::flush();
        Auth::logout();
        return Redirect('company/login');
    }

    public function changePassword()
    {
        return view('auth.changePassword');
    }
    public function updateChangePassword(Request $request)
    {
        $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required|min:6',
        ]);
    
        #Match The Old Password
        if(!Hash::check($request->currentpassword, auth()->user()->password)){
            return back()->with("error", "Old password is incorrect");
        }
        #Update the new Password
        Companies::where('Com_Id',auth()->user()->Com_Id)->update([
            'password' => Hash::make($request->newpassword)
        ]);
        session()->flash('success', 'Your password has been changed successfully.');
        return redirect()->route('changePassword')->with("massage", "Change your password");
    }
}