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
use App\Notifikasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Classes\PHPInsight\Sentiment;
use Session;

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
        $jatuhtempos = [];
        if(auth()->check() && auth()->user()->customer != null)
        {
            $jatuhtempos = PembayaranCicilan::whereNull('tanggal_bayar')
                ->whereDate('tenggat_waktu','<',date('Y-m-d'))
                ->get()
                ->filter(function ($value, $key) {
                    return ($value->cicilans->transaksis->customers->idcustomers == auth()->user()->customer->idcustomers)  && $value->cicilans->transaksis->status == 'aktif';
                });
        }
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
        $customer ->tempat_lahir = $request->get('tempatlahir');
        $customer ->tgl_lahir = Carbon::parse($request->get('tgllahir'))->format('Y-m-d');
        $customer ->gender = $request->get('gender');
        $customer->save();
        // simpan user
        $user = $customer->user;
        $user ->name = $request->get('nama');
        $user ->email = $request->get('email');
        $user->save();
        Session::flash('sukses', 'Data berhasil disimpan.');
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

    public function bacanotif(Notifikasi $notifikasi)
    {
        $notifikasi->dibaca = 'sudah';
        $notifikasi->save();
        return redirect('/');
    }

    public function index(Request $request)
    {
        if(auth()->check() && auth()->user()->pegawai != null)
        {
            return redirect('home');
        }
        if(auth()->check() && auth()->user()->customer != null)
        {
            $customer = auth()->user()->customer;
        }
        $notifikasis = [];
        $sortings = ['No Unit Terkecil', 'No Unit Terbesar', 'Harga Terendah', 'Harga Tertinggi'];
        $sort = $request->get('sorting') ?? 'No Unit Terkecil';
        if($sort == 'No Unit Terkecil') {
            $units = Unit::with('towers')->where('status', 'tersedia')->orderByRaw('CAST(no_unit as integer) ASC')->get();
        }
        elseif($sort == 'No Unit Terbesar') {
            $units = Unit::with('towers')->where('status', 'tersedia')->orderByRaw('CAST(no_unit as integer) DESC')->get();
        }
        elseif($sort == 'Harga Terendah') {
            $units = Unit::with('towers')->where('status', 'tersedia')->get()->sortBy(function ($item, $key){
                return $item->hargaJualCash();
            });
        }
        elseif($sort == 'Harga Tertinggi') {
            $units = Unit::with('towers')->where('status', 'tersedia')->get()->sortByDesc(function ($item, $key){
                return $item->hargaJualCash();
            });
        }
        $lokasi = $request->get('lokasi') ?? null;
        $harga_min = str_replace([',','.','Rp','rp'],'',$request->get('harga_min')) ?? null;
        $harga_max = str_replace([',','.','Rp','rp'],'',$request->get('harga_max')) ?? null;
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

        $jatuhtempos = [];
        if(auth()->check() && auth()->user()->customer != null)
        {
            $jatuhtempos = PembayaranCicilan::whereNull('tanggal_bayar')
                ->whereDate('tenggat_waktu','<',date('Y-m-d'))
                ->get()
                ->filter(function ($value, $key) {
                    return ($value->cicilans->transaksis->customers->idcustomers == auth()->user()->customer->idcustomers) && $value->cicilans->transaksis->status == 'aktif';
                });
        }

        // notifikasi
        if(isset($customer))
        {
            foreach($customer->transaksis as $transaksi)
            {
                if($transaksi->verifikasi == 'diterima')
                {
                    $namaNotif = 'Booking Transaksi '.$transaksi->id_transaksi;
                    if(Notifikasi::where('nama', $namaNotif)->count() <= 0)
                    {
                        $notif = new Notifikasi();
                        $notif->nama = $namaNotif;
                        $notif->pesan = $namaNotif.' diterima';
                        $notif->dibaca = 'belum';
                        $notif->customer = $customer->idcustomers;
                        $notif->save();
                    }
                }
                if($transaksi->batasBayarBooking())
                {
                    // otomatis dibatalkan
                    $unit = Unit::find($transaksi->units->id_unit);

                    $post = new Pembatalan();
                    $post ->tanggal_batal = Carbon::now();
                    $post ->transaksi = $transaksi->id_transaksi;
                    $post ->alasan = 'tidak membayar booking dalam 24 jam';
                    $post ->tgl_pengembalian= Carbon::now()->addDays(7);
                    $post ->admin = $transaksi->pegawais->nip;
                    $post->save();

                    $transaksi ->status = 'tidak aktif';
                    $transaksi->save();
                    
                    $unit ->status = 'tersedia';
                    $unit->save();

                    $namaNotif1 = 'Pembatalan Booking '.$transaksi->id_transaksi;
                    if(Notifikasi::where('nama', $namaNotif1)->count() <= 0)
                    {
                        $notif = new Notifikasi();
                        $notif->nama = $namaNotif1;
                        $notif->pesan = $namaNotif1.' diajukan (otomatis)';
                        $notif->dibaca = 'belum';
                        $notif->pegawai = $transaksi->pegawais->nip;
                        $notif->save();
                    }
                    $namaNotif2 = 'Pembatalan Booking Unit '.$transaksi->units->nama(). ' (otomatis)';
                    if(Notifikasi::where('nama', $namaNotif2)->count() <= 0)
                    {
                        $notif = new Notifikasi();
                        $notif->nama = $namaNotif2;
                        $notif->pesan = $namaNotif2;
                        $notif->dibaca = 'belum';
                        $notif->customer = $transaksi->customers->idcustomers;
                        $notif->save();
                    }
                }
                // dd($transaksi->batasBayarBooking());
                if($transaksi->cicilans != null)
                {
                    // lewat 6 bulan + 7 hari
                    if($transaksi->cicilans->batasWaktu())
                    {
                        // otomatis dibatalkan
                        $unit = Unit::find($transaksi->units->id_unit);

                        $post = new Pembatalan();
                        $post ->tanggal_batal = Carbon::now();
                        $post ->transaksi = $transaksi->id_transaksi;
                        $post ->alasan = 'tidak membayar cicilan selama 6 bulan lebih 7 hari';
                        $post ->tgl_pengembalian= Carbon::now()->addDays(7);
                        $post ->admin = $transaksi->pegawais->nip;
                        $post->save();

                        $transaksi ->status = 'tidak aktif';
                        $transaksi->save();
                        
                        $unit ->status = 'tersedia';
                        $unit->save();

                        $namaNotif1 = 'Pembatalan Transaksi '.$transaksi->id_transaksi;
                        if(Notifikasi::where('nama', $namaNotif1)->count() <= 0)
                        {
                            $notif = new Notifikasi();
                            $notif->nama = $namaNotif1;
                            $notif->pesan = $namaNotif1.' diajukan (otomatis)';
                            $notif->dibaca = 'belum';
                            $notif->pegawai = $transaksi->pegawais->nip;
                            $notif->save();
                        }
                        $namaNotif2 = 'Pembatalan Unit '.$transaksi->units->nama(). ' (otomatis)';
                        if(Notifikasi::where('nama', $namaNotif2)->count() <= 0)
                        {
                            $notif = new Notifikasi();
                            $notif->nama = $namaNotif2;
                            $notif->pesan = $namaNotif2;
                            $notif->dibaca = 'belum';
                            $notif->customer = $transaksi->customers->idcustomers;
                            $notif->save();
                        }
                    }
                    foreach($transaksi->cicilans->pembayaran_cicilans->where('cicilan_terakhir', 'iya') as $pembayaranCicilan)
                    {
                        if($pembayaranCicilan->gambar_bukticicilan != null && $pembayaranCicilan->verifikasi == 'diterima')
                        {
                            $namaNotif = 'Cicilan Transaksi '.$transaksi->id_transaksi;
                            if(Notifikasi::where('nama', $namaNotif)->count() <= 0)
                            {
                                $notif = new Notifikasi();
                                $notif->nama = $namaNotif;
                                $notif->pesan = $namaNotif.' lunas';
                                $notif->dibaca = 'belum';
                                $notif->customer = $customer->idcustomers;
                                $notif->save();
                            }
                        }
                    }
                }
            }
            $notifikasis = Notifikasi::where('customer', $customer->idcustomers)->where('dibaca', 'belum')->get();
        }

        return view('pengunjung.index', compact('units','feedbacks','promosis','totalLokasi','totalUnit','totalCustomer','totalTransaksi','lokasis','lokasi','harga_min','harga_max','jatuhtempos','notifikasis','sortings','sort'));
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
        $units_recommend = collect([]);
        if(auth()->check())
        {
            $customer = auth()->user()->customer;
            if($customer->unitDimiliki($unit)) {
                if($customer->transaksiUnit($unit)->verifikasi == 'tidak diterima') {
                    $units_recommend = Unit::where('tower', $unit->towers->id_tower)->orWhere('arah', $unit->arahs->id_arah)->orWhere('tipe', $unit->tipes->id_tipe)->limit(3)->get();
                }
            }
        }
        $lokasis = Lokasi::all();
        $chattings = [];
        if(auth()->check()){
            $chattings = Chatting::where('customer',auth()->user()->customer->idcustomers)->where('unit', $unit->id_unit)->get();
        }
        return view('pengunjung.listing-single', compact('unit','customer','lokasis','chattings','units_recommend'));
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
        $pegawai = Pegawai::where('jabatan','admin')->first()->nip ?? Pegawai::first()->nip;
        $customer = auth()->user()->customer;

        $chat= new Chatting();
        $chat->pesan=$request->get('pesan');
        $chat->tgl_pesan=Carbon::now();
        $chat->pegawai=$pegawai;
        $chat->customer=$customer->idcustomers;
        $chat->pengirim='customer';
        $chat->unit=$request->get('unit');
        $chat->save();

        $namaNotif = 'Chat '.$chat->id_chat;
        if(Notifikasi::where('nama', $namaNotif)->count() <= 0)
        {
            $notif = new Notifikasi();
            $notif->nama = $namaNotif;
            $notif->pesan = $namaNotif.'. Customer: '.$customer->nama.', Unit: '.Unit::find($request->get('unit'))->nama();
            $notif->dibaca = 'belum';
            $notif->pegawai = $pegawai;
            $notif->save();
        }
        return redirect('listing/'.$request->get('unit'))->with('pesan', 'Chat sudah terkirim');
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
        $post ->transaksi = Transaksi::where('customer', $request->get('customer'))->where('unit', $request->get('unit'))->first()->id_transaksi;
        $post ->isi = $request->get('isi');
        // $post ->reply = $request->get('reply');
        $post ->sentimen = $class;
        // $post ->reply = date('Y-m-d');
        $post->save();
        return redirect('listing/'.$request->get('unit'))->with('pesan', 'Feedback sudah terkirim');
        //
    }

    public function booking(Unit $unit)
    {
        try {
            $customer = auth()->user()->customer;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Anda Harus Login Terlebih Dahulu!");
        }
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
            $transaksi ->tgl_pelunasan = Carbon::now()->addMonths(2);
        }
        elseif($request->get('jenisbayar') == 'kredit keras')
        {
            $transaksi ->tgl_pelunasan = Carbon::now()->addMonths(6);   
        }
        elseif($request->get('jenisbayar') == 'in house')
        {
            $transaksi ->tgl_pelunasan = Carbon::now()->addYears(3);   
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
            if(isset($pembayaranCicilan->gambar_bukticicilan) && is_file($pembayaranCicilan->gambar_bukticicilan))
            {
                unlink(public_path($pembayaranCicilan->gambar_bukticicilan));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $pembayaranCicilan ->gambar_bukticicilan= $nama_gambar;
        }
        $pembayaranCicilan->verifikasi = 'diproses';
        $pembayaranCicilan->save();

        $namaNotif = 'Cicilan Transaksi '.$pembayaranCicilan->cicilans->transaksi;
        $notif = new Notifikasi();
        $notif->nama = $namaNotif;
        $notif->pesan = $namaNotif.' dibayar';
        $notif->dibaca = 'belum';
        $notif->pegawai = $pembayaranCicilan->cicilans->transaksis->pegawais->nip;
        $notif->save();
        request()->session()->flash('pesan','Bukti pembayaran cicilan tersimpan');
        return redirect()->route('pengunjung.cicilan',$pembayaranCicilan->cicilans);
    }

    public function map(Lokasi $lokasi)
    {
        return view('pengunjung.maps', compact('lokasi'));
    }
}
