<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profil;
use App\Pegawai;
use App\Customer;
use App\Lokasi;
use App\Unit;
use App\Transaksi;
use App\PembayaranBooking;
use App\PembayaranDP;
use App\Pembatalan;
use App\Cicilan;
use App\PembayaranCicilan;
use App\Feedback;
use App\Promosi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
        $customer = auth()->user()->customer;
        $transaksis = $customer->transaksis;
        return view('pengunjung.auth.profil', compact('customer','transaksis'));
    }

    public function ubahProfil(Customer $customer)
    {
        // $customer = auth()->user()->customer;
        return view('pengunjung.auth.ubah', compact('customer'));
    }

    public function simpanProfil(Request $request, Customer $customer)
    {
        $customer ->nama = $request->get('nama');
        $customer ->alamat = $request->get('alamat');
        $customer ->no_telp = $request->get('notelp');
        $customer ->no_ktp = $request->get('noktp');
        // $customer ->tempat_lahir = $request->get('tempatlahir');
        $customer ->tgl_lahir = $request->get('tgllahir');
        $customer ->gender = $request->get('gender');
        $customer->save();
        // simpan user
        $user = $customer->user;
        $user ->name = $request->get('nama');
        $user ->email = $request->get('email');
        $user->save();
        return redirect('ubahprofil/'.$customer->idcustomers);
    }

    public function ubahPassword(Customer $customer)
    {
        return view('pengunjung.auth.ubahpassword', compact('customer'));
    }

    public function simpanPassword(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $customer->user;
        if (Hash::check($request->get('password_lama'),$user->password)) 
        {
            $user ->password = bcrypt($request->get('password'));
            $user->save();
        }
        else
        {
            return redirect('ubahpassword/'.$customer->idcustomers)->with('error', 'Password lama tidak sesuai');
        }
        return redirect('ubahprofil/'.$customer->idcustomers);
    }

    public function index()
    {
        $units = Unit::all();
        $feedbacks = Feedback::all();
        $promosis = Promosi::where('tgl_awal','<=',date('Y-m-d'))->where('tgl_akhir','>=',date('Y-m-d'))->get();

        $totalLokasi = Lokasi::count();
        $totalUnit = Unit::count();
        $totalCustomer = Customer::count();
        $totalTransaksi = Transaksi::count();

        return view('pengunjung.index', compact('units','feedbacks','promosis','totalLokasi','totalUnit','totalCustomer','totalTransaksi'));
    }

    public function about()
    {
        $welcome = Profil::where('judul_profil','welcome')->first()->keterangan;
        $visi = Profil::where('judul_profil','visi')->first()->keterangan;
        $misi = Profil::where('judul_profil','misi')->first()->keterangan;
        $nilai = Profil::where('judul_profil','nilai')->first()->keterangan;

        $totalLokasi = Lokasi::count();
        $totalUnit = Unit::count();
        $totalCustomer = Customer::count();
        $totalTransaksi = Transaksi::count();
        $feedbacks = Feedback::all();
        return view('pengunjung.about', compact('feedbacks','welcome','visi','misi','nilai','totalLokasi','totalUnit','totalCustomer','totalTransaksi'));
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
            $customer = auth()->user()->customer;
        }
        return view('pengunjung.listing-single', compact('unit','customer'));
    }

    public function contact()
    {
        $pegawais = Pegawai::all();
        $customers = Customer::all();
        $lokasis = Lokasi::all();
        return view('pengunjung.contact', compact('pegawais','customers','lokasis'));
    }

    public function feedback(Request $request)
    {
        $lokasi = Lokasi::find($request->get('lokasi'));
        $post = new Feedback();
        $post ->tanggal_feedback = $request->get('tanggal_feedback');
        $post ->lokasi = $request->get('lokasi');
        $post ->pegawai = $lokasi->lokasipegawais->first()->nip ?? Pegawai::first()->nip;
        $post ->customer = $request->get('customer');
        $post ->isi = $request->get('isi');
        // $post ->reply = $request->get('reply');
        $post ->reply = date('Y-m-d');
        $post->save();
        return redirect('contact');
        //
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

    public function cicilan(Cicilan $cicilan)
    {
        $pembayaran_cicilans = $cicilan->pembayaran_cicilans;
        $transaksi = $cicilan->transaksis;
        $unit = $transaksi->units;
        return view('pengunjung.transaksi.cicilan', compact('pembayaran_cicilans','cicilan','transaksi','unit'));
    }

    public function bayarCicilan(PembayaranCicilan $pembayaran_cicilan)
    {
        $cicilan = $pembayaran_cicilan->cicilans;
        $transaksi = $cicilan->transaksis;
        $unit = $transaksi->units;
        return view('pengunjung.transaksi.bayarcicilan', compact('pembayaran_cicilan','cicilan','transaksi','unit'));
    }

    public function simpanCicilan(Request $request, PembayaranCicilan $pembayaranCicilan)
    {
        $pembayaranCicilan ->tanggal_bayar = Carbon::now();
        // upload bukti
        $file = $request->file('bukti');
        if(isset($file))
        {
            if(isset($pembayaranCicilan->gambar_bukticicilan))
            {
                unlink(public_path($pembayaranCicilan->gambar_bukticicilan));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $pembayaranCicilan ->gambar_bukticicilan= $nama_gambar;
        }
        $pembayaranCicilan->save();
        request()->session()->flash('pesan','Bukti pembayaran cicilan tersimpan');
        return redirect()->route('pengunjung.cicilan',$pembayaranCicilan->cicilans);
    }
}
