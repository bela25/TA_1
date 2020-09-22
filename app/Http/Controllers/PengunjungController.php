<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengunjungController extends Controller
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
        return view('pengunjung.index');
    }

    public function about()
    {
        return view('pengunjung.about');
    }

    public function services()
    {
        return view('pengunjung.services');
    }

    public function listing()
    {
        return view('pengunjung.listing');
    }

    public function listingSingle()
    {
        return view('pengunjung.listing-single');
    }

    public function agent()
    {
        return view('pengunjung.agent');
    }

    public function contact()
    {
        return view('pengunjung.contact');
    }

    public function blog()
    {
        return view('pengunjung.blog');
    }
}
