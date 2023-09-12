<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\MasterAdmin;


class ForgotPasswordBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function submitForgetPasswordForm(Request $request){
      // $request->validate([
      //   'email' => 'required|email|exists:users',
      // ]);
      $token = Str::random(64);
      DB::table('password_resets')->insert([
          'email' => $request->email, 
          'token' => $token, 
          'created_at' => Carbon::now()
        ]);
      
      Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
          $message->to($request->email);
          $message->subject('Reset Password');
      });

      return back()->with('message', 'We have e-mailed your password reset link!');
  }
}
