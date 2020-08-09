<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaiLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer');
    }

     /**
     * Show the application's login form for pegawai.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.pegawai-login');
    }

    /**
     * Handle a login request to the application for pegawai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // validate login request
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // attempt to log in the pegawai
        if (Auth::guard('pegawai')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            // if success, redirect to intended location
            return redirect()->intended(route('pegawais.index'));
        }

        // if unsuccessful, redirect back to login form
        return redirect()->back()->withInput($request->only('username'))->withErrors(['username' => "Username atau password salah."]);
    }
}
