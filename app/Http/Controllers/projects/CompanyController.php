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
use App\Traits\ResponseFormat;
use Hash;
use DB;
use Exception;

class CompanyController extends Controller
{
    use ResponseFormat;
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
    } 
    
    public function customLogin(Request $request){   
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
        return redirect("company/login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    
    public function dashboard(){
        if(Auth::check()){
            return view('companypakage.list');
        }
  
        return redirect("company/login")->withSuccess('Opps! You do not have access');
    }

    public function create() {
      
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.companyRegister', ['pageConfigs' => $pageConfigs]);

    }
   
    
    public function customRegistration(Request $request){
        
        $validatedData = $request->validate([
            'companyname' => 'required',
            // 'email' => 'required|email|unique:companies',
            'password' => 'required|min:6',
            'confirmpassword' => 'required_with:password|same:password|min:6'
        ], 
        [
            'companyname.required' => 'company name field is required.',
            // 'email.required' => 'email field is required.',
            'password.required' => 'password field is required.',
            'confirmpassword.required' => 'confirm password field is required.',
            'confirmpassword.min' => 'confirm password must be at least 6 characters long.',
        ]);
            
            
            $token = Str::random(64); //Email Verify Token Generate
            $otp = rand(1000,9999);
            $companies = Companies::where('email',$request->email)->first();
            if(!empty($companies)){
                $companies->CompanyName = $request-> companyname ;
                $companies->CompanyImage = $request-> companyimage ;
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
                // $companies->CAffiliateCode = $request-> caffiliateCode ;
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
                return redirect()->route("emailVerifyOtp".$companies->id);
            }
    }

    public function emailVerifyOtp(){
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-verify-email-otp-basic', ['pageConfigs' => $pageConfigs]);
    }
    public function resednGenerateOTP()
    {
        return Str::rand(4); // Generates a 4-digit OTP
        // $otp = rand(1000,9999);
    }
    public function resendOtp($id)
    {
        // Find the company by ID
        $companies = Companies::find($id);
        dd($companies);
        if (!$companies) {
            // Handle the case where the user doesn't exist
            // You can redirect or return an error message
        }
        
        // Generate a new OTP
        $otp = $this->resednGenerateOTP();
        
        $companies->EmailVerifyOtp = $otp;
        $companies->save();
        $details = [
            'email' => $companies->Email,
            'otp' => $companies->EmailVerifyOtp,
        ];
        Mail::to($companies->Email)->send(new \App\Mail\otpregistermail($details));
        // return redirect()->route("emailVerifyOtp".$companies->id);
        return view('content.authentications.auth-verify-email-otp-basic')->with('companies', $companies);
    }

    // public function resendOtp($Com_Id)
    // {
    //     $user = Auth::user(); // Assuming you're using authentication
    // $otp = generate_otp(); // Replace with your OTP generation logic

    // Mail::to($user->email)->send(new OtpEmail($otp));

    // return redirect()->back()->with('success', 'OTP resent successfully');
    // }

    public function thankyou(){
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-thankyou-basic', ['pageConfigs' => $pageConfigs]);
    }
    
 
    // public function emailVerifyLogin(Request $request){   
    //     $userEnteredOtp = $request->input('otp');
    //     $storedotp = Companies::select('EmailVerifyOtp','EmailVerify', 'Com_Id')->where('EmailVerifyOtp',$userEnteredOtp)->first();
      
    //     $companies = Companies::find($storedotp->Com_Id);
        
    //     if(!empty($storedotp))
    //     {            
    //         if ($storedotp->EmailVerifyOtp == $userEnteredOtp )
    //         {
    //             if (!is_null($storedotp)) 
    //             {
    //                 if ($storedotp->EmailVerify == 0) 
    //                 { 
    //                     $companies->EmailVerify = '1';
    //                     $companies->save();
    //                     return redirect()->route('thankyou');
    //                 } 
    //             } else {
    //                 return redirect()->route('emailVerifyOtp');
    //             }
    //         }else{
    //             return redirect()->route('emailVerifyOtp');
    //         }
    //     }
    //     return redirect()->route('emailVerifyOtp');
    // }
    // public function emailVerifyLogin(Request $request){   
    //     $userEnteredOtp = $request->input('otp');
    //     $storedotp = Companies::select('EmailVerifyOtp','EmailVerify', 'Com_Id')->where('EmailVerifyOtp', $userEnteredOtp)->first();
      
    //     if (!empty($storedotp)) {            
    //         if ($storedotp->EmailVerifyOtp == $userEnteredOtp) {
    //             if ($storedotp->EmailVerify == 0) { 
    //                 $companies = Companies::find($storedotp->Com_Id);
    //                 if (!is_null($companies)) {
    //                     $companies->EmailVerify = '1';
    //                     $companies->save();
    //                     return redirect()->route('thankyou');
    //                 } else {
    //                     return redirect()->route('emailVerifyOtp');
    //                 }
    //             } else {
    //                 return redirect()->route('emailVerifyOtp');
    //             }
    //         } else {
    //             return redirect()->route('emailVerifyOtp');
    //         }
    //     }
    //     return redirect()->route('emailVerifyOtp');
    // }
    
    public function emailVerifyLogin(Request $request) {
        $userEnteredOtp = $request->input('otp');
        
        // Attempt to retrieve a record from the database based on the entered OTP
        $storedotp = Companies::select('EmailVerifyOtp', 'EmailVerify', 'Com_Id')
            ->where('EmailVerifyOtp', $userEnteredOtp)
            ->first();
      
        if (!empty($storedotp)) {
            // Check if the entered OTP matches the stored OTP
            if ($storedotp->EmailVerifyOtp == $userEnteredOtp) {
                // Check if the EmailVerify status is 0
                if ($storedotp->EmailVerify == 0) {
                    // Retrieve the corresponding company based on Com_Id
                    $companies = Companies::find($storedotp->Com_Id);
    
                    if (!is_null($companies)) {
                        // Update the EmailVerify status to 1 and save the changes
                        $companies->EmailVerify = '1';
                        $companies->save();
                        return redirect()->route('thankyou'); // Successful verification
                    } else {
                        // Company not found
                        return redirect()->route('emailVerifyOtp');
                    }
                } else {
                    // Email already verified
                    return redirect()->route('emailVerifyOtp');
                }
            } else {
                // OTP doesn't match
                return redirect()->route('emailVerifyOtp');
            }
        } else {
            // OTP not found in the database
            return redirect()->route('emailVerifyOtp');
        }
    }
    
   
   
    public function verifyAccount($token){   
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

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('company/login');
    }

    public function changePassword(){
        return view('auth.changePassword');
    }
    public function updateChangePassword(Request $request){
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
    
    public function GenerateRefferCode($companyDetail){
        if(!empty($companyDetail)){
            $reffercode = 'C'.strtoupper(substr($companyDetail->CompanyName,0,5));
            return  
                (strlen($companyDetail->Com_Id) > 1) ? ($reffercode.$companyDetail->Com_Id) : $reffercode.'0'.$companyDetail->Com_Id;
        }
        return '';
    }
    
    public function basicInfoStore(Request $request){
        try{
            $companyName = $request->input('companyName');
            $email = $request->input('email');
            $password = $request->input('password');
            $companies = Companies::where('email',$email)->first();
            if(empty($companies)){
                $companies = new Companies();
                $companies->CompanyName = $companyName ;
                $companies->Email = $email ;
                $companies->password = Hash::make($password);
                $companies->CAffiliateCode = self::GenerateRefferCode($companies);
                $companies->save();
                if($companies){
                    $companies->CAffiliateCode = self::GenerateRefferCode($companies);
                    $companies->save();
                    return  $this->sendResponse($companies,'Company Register...');
                }
            }else{
                return  $this->sendResponse($companies,'Company already register...');  
            }
            
        }catch(\Exception $exception){
            return $this->sendError($exception->getMessage(),404);
        }
    }
}