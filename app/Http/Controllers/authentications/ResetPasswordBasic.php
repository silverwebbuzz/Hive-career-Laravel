<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\MasterAdmin;
use Hash;
class ResetPasswordBasic extends Controller
{
  
  public function index(){
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-reset-password-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function submitResetPasswordForm(Request $request){
    // $request->validate([
    //                       'email' => 'required|email|exists:users',
    //                       'password' => 'required|string|min:6|confirmed',
    //                       'password_confirmation' => 'required'
    //                   ]);
    $updatePassword = DB::table('password_resets')->where('token',substr($request->Token,0,-1))->first();
    if(empty($updatePassword)){
        return back()->withInput()->with('error', 'Invalid token!');
    }
    $user = MasterAdmin::where('email', $updatePassword->email)
                ->update(['password' => Hash::make($request->password)]);
    DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

    return redirect('/login')->with('message', 'Your password has been changed!');
  }
}
