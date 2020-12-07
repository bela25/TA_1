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
use App\Chatting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Classes\PHPInsight\Sentiment;

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
        $jatuhtempos = PembayaranCicilan::whereNull('tanggal_bayar')->whereDate('tenggat_waktu','<',date('Y-m-d'))->get();
        return view('pengunjung.auth.profil', compact('customer','transaksis','jatuhtempos'));
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

    public function index(Request $request)
    {
        if(auth()->check() && auth()->user()->pegawai != null)
        {
            return redirect('home');
        }
        $units = Unit::with('towers')->get();
        $lokasi = $request->get('lokasi') ?? null;
        $harga_min = $request->get('harga_min') ?? null;
        $harga_max = $request->get('harga_max') ?? null;
        if($lokasi != null)
        {
            $units = $units->filter(function ($item) use($lokasi) {
                return $item->towers->lokasi == $lokasi;
            });
        }
        if($harga_min != null)
        {
            $units = $units->filter(function ($item) use($harga_min) {
                return $item->hargaJualCash() >= $harga_min;
            });
        }
        if($harga_max != null)
        {
            $units = $units->filter(function ($item) use($harga_max) {
                return $item->hargaJualCash() <= $harga_max;
            });
        }

        $feedbacks = Feedback::all();
        $promosis = Promosi::where('tgl_awal','<=',date('Y-m-d'))->where('tgl_akhir','>=',date('Y-m-d'))->get();
        $lokasis = Lokasi::all();

        $totalLokasi = Lokasi::count();
        $totalUnit = Unit::count();
        $totalCustomer = Customer::count();
        $totalTransaksi = Transaksi::count();

        $jatuhtempos = PembayaranCicilan::whereNull('tanggal_bayar')->whereDate('tenggat_waktu','<',date('Y-m-d'))->get();

        return view('pengunjung.index', compact('units','feedbacks','promosis','totalLokasi','totalUnit','totalCustomer','totalTransaksi','lokasis','lokasi','harga_min','harga_max','jatuhtempos'));
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
        $chattings = [];
        if(auth()->check()){
            $chattings = Chatting::where('customer',auth()->user()->customer->idcustomers)->get();
        }
        return view('pengunjung.contact', compact('pegawais','customers','lokasis','chattings'));
    }

    public function chat(Request $request)
    {
        $chat= new Chatting();
        $chat->pesan=$request->get('pesan');
        $chat->tgl_pesan=Carbon::now();
        $chat->pegawai=Pegawai::where('jabatan','admin')->first()->nip ?? Pegawai::first()->nip;
        $chat->customer=auth()->user()->customer->idcustomers;
        $chat->pengirim='customer';
        $chat->save();
        return redirect('contact');
    }

    public function feedback(Request $request)
    {
        $sentiment = new Sentiment();
        $scores = $sentiment->score($request->get('isi'));
        $class = $sentiment->categorise($request->get('isi'));

        $lokasi = Lokasi::find($request->get('lokasi'));
        $post = new Feedback();
        $post ->tanggal_feedback = $request->get('tanggal_feedback');
        $post ->lokasi = $request->get('lokasi');
        $post ->pegawai = $lokasi->lokasipegawais->first()->nip ?? Pegawai::first()->nip;
        $post ->customer = $request->get('customer');
        $post ->isi = $request->get('isi');
        // $post ->reply = $request->get('reply');
        $post ->sentimen = $class;
        $post ->reply = date('Y-m-d');
        $post->save();
        return redirect('contact');
        //
    }

    public function booking(Unit $unit)
    {
        $customer = auth()->user()->customer;
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
        $customer = auth()->user()->customer;
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

    public function simpanJenisBayar(Request $request, Transaksi $transaksi)
    {
        $transaksi->jenis_bayar = $request->jenisbayar;
        if($request->get('jenisbayar') == 'kpa')
        {
            $transaksi ->tgl_pelunasan = Carbon::now()->addDays(30);
        }
        elseif($request->get('jenisbayar') == 'cash keras')
        {
            $transaksi ->tgl_pelunasan = Carbon::now()->addMonths(6);   
        }
        elseif($request->get('jenisbayar') == 'in house')
        {
            $transaksi ->tgl_pelunasan = Carbon::now()->addYears(10);   
        }
        $transaksi->save();
        // dd($transaksi->id_transaksi);
        return redirect()->route('pengunjung.dp', $transaksi->units);
        // return view('pengunjung.transaksi.dp', compact('unit','customer','transaksi','pembayaranDP'));
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

    public function map(Lokasi $lokasi)
    {
        return view('pengunjung.maps', compact('lokasi'));
    }
}
