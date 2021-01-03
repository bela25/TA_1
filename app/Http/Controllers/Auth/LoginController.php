<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Customer;
use App\Pegawai;
use App\User;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    // public function username()
    // {
    //     return 'email';
    // }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    // protected function guard()
    // {
    //     return Auth::guard('pegawai');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (User::where('email', $request->get('email'))->count() > 0) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect()->intended('home');
            }
            else {
                $errors['password'] = 'The provided password do not match our records.';
            }
        }
        else {
            $errors['email'] = 'The provided email do not match our records.';
        }        

        return back()->withErrors($errors)->withInput($request->except('password'));
    }

    // public function login(Request $request)
    // {
    //     if (Auth::guard('pegawai')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // Authentication passed...
    //         return redirect()->intended('home');
    //     }
    //     elseif (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // Authentication passed...
    //         return redirect()->intended('home');
    //     }
    // }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        if($request->has('from') && $request->get('from') == 'pengunjung')
        {
            return redirect('/');
        }
        return redirect('/home');
    }
}
