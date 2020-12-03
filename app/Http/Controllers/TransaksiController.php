<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Customer;
use App\Pegawai;
use App\HargaJual;
use App\Unit;
use App\KomisiPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // pegawai yang login
        $pegawai = auth()->user()->pegawai;
        // $transaksis = Transaksi::all();
        $transaksis = Transaksi::all()->filter(function ($item, $key) use($pegawai) {
            return in_array($item->lokasi()->idlokasi, $pegawai->lokasipegawais->pluck('lokasi')->toArray());
        });
        // dd($transaksis[1]->customers->verifikasis->last()->tgl_diterima);
        // $transaksis = $pegawai->transaksis;
        return view('transaksi.index',compact('transaksis','pegawai'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer= Customer::all();
        $pegawai=Pegawai::all();
        $hargajual=HargaJual::all();
        $unit= Unit::all();
        return view('transaksi.create',compact('customer','pegawai','hargajual','unit'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = Transaksi::where('customer',$request->get('customer'))->where('unit',$request->get('unit'))->get();
        if($transaksi->count() <= 0)
        {
            $post = new Transaksi();
            $post ->tanggal = Carbon::now();
            $post ->customer = $request->get('customer');
            $post ->unit = $request->get('unit');
            // $post ->jenis_bayar = $request->get('jenisbayar');
            $post ->status = 'aktif';
            $post ->verifikasi = 'belum diterima';
            // $post ->tanggal_batal = $request->get('tanggalbatal');
            // $post ->tanggal= $request->get('tglpembayaran');
            // $post ->tgl_pelunasan= $request->get('tglpelunasan');
            $post->save();

            $unit = Unit::find($request->get('unit'));
            // $unit ->status = 'booking';
            $unit->save();
            request()->session()->flash('pesan','Berhasil booking');
        }
        else
        {
            request()->session()->flash('pesan','Anda sudah membooking unit ini');
        }
        return redirect()->route('pengunjung.booking',$request->get('unit'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $pembayaran_dp=$transaksi->pembayarandps;
        $pembayaran_booking=$transaksi->pembayaranbookings;
        $cicilan=$transaksi->cicilans;
        // if($pembayaran_dp == null)
        // {
        //     return redirect('transaksis')->with('pesan', 'Belum ada pembayaran DP');
        // }
        return view('transaksi.show', compact('transaksi','pembayaran_dp','pembayaran_booking','cicilan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $customers = Customer::all();
        $units = Unit::all();
        $pegawais = Pegawai::all();
        $pegawai_nip = null;
        if(isset($transaksi->pegawai))
        {
            $pegawai_nip = $transaksi->pegawais->nip;
        }
        $jenisBayars = ['KPA','Lunas','In House','Cash Keras'];
        return view('transaksi.update',compact('transaksi','customers','units','jenisBayars','pegawais','pegawai_nip'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        // $transaksi ->unit = $request->get('unit');
        // $transaksi ->tanggal= $request->get('tglpembayaran');
        // $transaksi ->customer = $request->get('customer');
        $transaksi ->pegawai = $request->get('pegawai');
        $transaksi ->jenis_bayar = $request->get('jenisbayar');
        $transaksi ->status = $request->get('status');
        $transaksi ->verifikasi = $request->get('verifikasi');
        if($request->get('verifikasi') == 'diterima'){
            $unit =$transaksi->units;
            $unit ->status = 'booking';
            $unit->save();

            $transaksi_lain = Transaksi::where('unit',$transaksi->unit)->where('id_transaksi','!=',$transaksi->id_transaksi)->get();
            foreach($transaksi_lain as $tl)
            {
                $tl->verifikasi = 'tidak diterima';
                $tl->save();
            }
        }
        // if($request->get('tglpelunasan') == null)
        // {
        //     $transaksi ->tgl_pelunasan = $request->get('tglpelunasan');
        // }
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
        // check hak akses user, jika customer kembali ke halaman pengunjung
        $customer = false;
        if($customer)
        {
            return redirect('dp/'.$transaksi->id_transaksi);
        }
        return redirect('transaksis');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect('transaksis');
        //
    }

    public function ubahPegawai(Request $request, Transaksi $transaksi)
    {
        $pegawais = Pegawai::all();
        $pegawai_nip = null;
        if(isset($transaksi->pegawai))
        {
            $pegawai_nip = $transaksi->pegawais->nip;
        }
        return view('transaksi.ubahpegawai', compact('transaksi','pegawais','pegawai_nip'));
        //
    }

    public function simpanpegawai(Request $request, Transaksi $transaksi)
    {
        $transaksi ->pegawai = $request->get('pegawai');
        $transaksi->save();

        $komisiPegawai = new KomisiPegawai();
        $komisiPegawai ->bonus = $transaksi->units->hargaJualCash() * 2 / 100;
        $komisiPegawai ->transaksi = $transaksi->id_transaksi;
        $komisiPegawai->save();
        return redirect('transaksis');
        //
    }
}
