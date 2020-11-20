<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->customer != null)
        {
            return redirect()->route('pengunjung.index');
        }
        elseif(auth()->user()->pegawai != null)
        {
            return view('home');
        }
    }
}
