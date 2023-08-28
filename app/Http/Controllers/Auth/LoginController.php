<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Log;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Session;
use Auth;
use Carbon\Carbon;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {

        logout as performLogout;
  
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        /*$this->username = $this->findUsername();*/
        
    }

   
 

    // LOGIN CREDENTIALS
    public function login (Request $request)
    {
      

        $login = $request->input('login');
        $user = User::where('email', $login)->orWhere('username', $login)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['login' => 'Invalid Login credentials']);
        }

        $request->validate([
            'password' => 'required|min:8',
        ]);
        

        $remember_me = $request->has('remember_me') ? true : false; 

        if (Auth::attempt(['username' => $user->username, 'password' => $request->password], $remember_me ) || 
            Auth::attempt(['email' => $user->email, 'password' => $request->password], $remember_me )) 
        {
            $type = Auth::user()->user_status;

            if ($type == 0) {

                $timestamp = Carbon::now()->timezone('Asia/Manila');

                $logIN = new Log();

                $logIN->uID = Auth::user()->uID;
                $logIN->logSTAT =  '1';
                $logIN->created_at = $timestamp ;  
                $logIN->updated_at = $timestamp ;  

                $logIN->save();  
                return redirect('/home');

            } else if($type == 1) {
                Auth::logout();
                return redirect('/login')->withErrors(['deact' => 'Your account has been disabled.']);
            }
            
        } 

        else 
        {
            return redirect()->back()->withErrors(['password' => 'Invalid Login credentials']);
        }
    }

   


    public function logout(Request $request)
    {
        Session::flush();
        
         $uID =  Auth::user()->uID;
        Auth::logout();

        $timestamp = Carbon::now()->timezone('Asia/Manila');
        
        $logOUT = new Log();

        $logOUT->uID = $uID;
        $logOUT->logSTAT = '0';
        $logOUT->created_at = $timestamp ;  
        $logOUT->updated_at = $timestamp ;  
        
        $logOUT->save();  
        return redirect('/');
    }


}
