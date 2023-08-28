<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

/*class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /*use SendsPasswordResetEmails;
}*/

class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users_tb',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
          
            $action_link = route('reset.password.get', ['token'=>$token,'email'=>$request->email]);
            $body = "We are received a request to reset the password for <b>Obando Seventh-Day Adventish Church</b>
            account associated with ".$request->email.". You can reset your password by clicking the link below.";
  
          Mail::send('email.forgetPassword',['action_link'=>$action_link, 'body'=>$body], function($message) use ($request) {
              /*['token' => $token], function($message) use($request)*/
            
            /*$message->to($request->email);
              $message->subject('Reset Password');*/
              $message->from('noreply@example.com', 'Obando Seventh-Day Adventist Church');
              $message->to($request->email, 'Obando Seventh-Day Adventist Church')->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */

      public function showResetPasswordForm(Request $request, $token = null) { 
        return view('auth.forgetPasswordLink')->with(['token'=>$token, 'email'=>$request->email]);
        /*return view('auth.forgetPasswordLink', ['token' => $token]);*/
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users_tb',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
          ])->first();

          if(!$check_token) {
            return back()->withInput('fail','Invalid token');
          } else {

            User::where('email', $request->email)->update([
                'password'=>Hash::make($request->password)
            ]);

            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            return redirect('/login')->with('info', 'Your password has been changed! You can now login')
            ->with('verfiedEmail', $request->email);
          }
  
      }

      
}