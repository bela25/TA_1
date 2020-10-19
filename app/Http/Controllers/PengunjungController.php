<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Customer;
use App\Transaksi;
use App\PembayaranBooking;
use App\PembayaranDP;
use App\Pembatalan;

class PengunjungController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login()
    {
        return view('pengunjung.auth.login');
    }

    public function register()
    {
        return view('pengunjung.auth.register');
    }

    public function profil()
    {
        $customer = Customer::find(2);
        $transaksis = $customer->transaksis;
        return view('pengunjung.auth.profil', compact('customer','transaksis'));
    }

    public function index()
    {
        $units = Unit::all();
        return view('pengunjung.index', compact('units'));
    }

    public function about()
    {
        return view('pengunjung.about');
    }
    
    public function listing()
    {
        $units = Unit::all();
        return view('pengunjung.listing', compact('units'));
    }

    public function listingSingle(Unit $unit)
    {
        $customer = null;
        if(auth()->check())
        {
            $customer = Customer::find(2);
        }
        return view('pengunjung.listing-single', compact('unit','customer'));
    }

    public function contact()
    {
        return view('pengunjung.contact');
    }

    public function booking(Unit $unit)
    {
        $customer = Customer::find(2);
        $transaksi = Transaksi::where('customer',$customer->idcustomers)->where('unit',$unit->id_unit)->latest()->first();
        $pembayaranBooking = null;
        if($transaksi == null)
        {
            $transaksi = null;
        }
        else
        {
            $pembayaranBooking = PembayaranBooking::where('transaksi',$transaksi->id_transaksi)->first();
        }
        return view('pengunjung.transaksi.booking', compact('unit','customer','transaksi','pembayaranBooking'));
    }

    public function dp(Unit $unit)
    {
        $customer = Customer::find(2);
        $transaksi = Transaksi::where('customer',$customer->idcustomers)->where('unit',$unit->id_unit)->latest()->first();
        $pembayaranDP = null;
        if($transaksi == null)
        {
            $transaksi = null;
        }
        else
        {
            $pembayaranDP = PembayaranDP::where('transaksi',$transaksi->id_transaksi)->first();
        }
        // dd($transaksi->id_transaksi);
        return view('pengunjung.transaksi.dp', compact('unit','customer','transaksi','pembayaranDP'));
    }

    public function pembatalan(Transaksi $transaksi)
    {
        $unit = $transaksi->units;
        $pembatalan = Pembatalan::where('transaksi',$transaksi->id_transaksi)->first();
        if($pembatalan == null)
        {
            $pembatalan = null;
        }
        return view('pengunjung.transaksi.pembatalan', compact('transaksi','unit','pembatalan'));
    }
}
