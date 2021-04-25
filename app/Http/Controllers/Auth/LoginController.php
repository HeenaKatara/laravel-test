<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;  
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    public function user_login()
    {
        return view("auth.login");
    }

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
    public function user_login_store(Request $request){
        // Retrive Input
        $credentials = $request->only('email', 'password');
        
        $userExist = User::where('email',$request->email)->first();
        if($userExist['is_admin'] == 1){
            $users = User::where('is_admin','!=',1)->get();
            if (Auth::attempt($credentials)) {
                return view('admin.index', compact('users'));
            }
        } else {
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            } 
        }
        
        // if failed login
        return redirect()->route('user_login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('user_login');
    }
}
