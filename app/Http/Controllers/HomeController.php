<?php

namespace App\Http\Controllers;

use App\Notifikasi;
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
            // $namaNotif = 'Unit Test';
            // $notif = new \App\Notifikasi();
            // $notif->nama = $namaNotif;
            // $notif->pesan = $namaNotif.' dibooking';
            // $notif->dibaca = 'belum';
            // $notif->pegawai = \App\Pegawai::where('jabatan', 'admin')->first()->nip;
            // $notif->save();

            $notifikasis = Notifikasi::where('pegawai', auth()->user()->pegawai->nip)->where('dibaca', 'belum')->get();
            return view('home', compact('notifikasis'));
        }
    }
}
