<?php

namespace App\Http\Controllers;

use App\Pembatalan;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Pegawai;
use App\Unit;
use Carbon\Carbon;

class PembatalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembatalans= Pembatalan::all();
        return view('pembatalan.index',compact('pembatalans'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $pegawai=Pegawai::all();
       $transaksi=Transaksi::all();
       return view('pembatalan.create',compact('pegawai','transaksi'));
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
        $transaksi = Transaksi::find($request->get('transaksi'));
        $unit = Unit::find($transaksi->units->id_unit);

        $post = new Pembatalan();
        $post ->tanggal_batal = Carbon::now();
        $post ->transaksi = $request->get('transaksi');
        $post ->alasan = $request->get('alasan');
        $post ->tgl_pengembalian= Carbon::now()->addDays(7);
        $post ->admin = $request->get('admin');
        $post->save();

        $transaksi ->status = 'tidak aktif';
        $transaksi->save();
        
        $unit ->status = 'booking';
        $unit->save();
        return redirect('pembatalan')->with('pesan','Berhasil membatalkan transaksi');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembatalan  $pembatalan
     * @return \Illuminate\Http\Response
     */
    public function show(Pembatalan $pembatalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembatalan  $pembatalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembatalan $pembatalan)
    {
        return view('pembatalan.update',compact('pembatalan'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembatalan  $pembatalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembatalan $pembatalan)
    {
        // $pembatalan ->transaksi = $request->get('customer');
        $pembatalan ->alasan = $request->get('alasan');
        $pembatalan ->tanggal_batal= $request->get('tanggal_batal');
        $pembatalan ->tgl_pengembalian= $request->get('tglpengembalian');
        $pembatalan ->admin = $request->get('admin');

        $file = $request->file('bukti');
        if(isset($file))
        {
            if(isset($pembatalan->gambar_bukti))
            {
                unlink(public_path($pembatalan->gambar_bukti));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $pembatalan ->gambar_bukti = $nama_gambar;
        }
        $pembatalan->save();
        return redirect('pembatalans');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembatalan  $pembatalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembatalan $pembatalan)
    {
        $pembatalan->delete();
        return redirect('transaksis');
        //
    }

    public function uploadBukti(Pembatalan $pembatalan)
    {
        $pegawais = Pegawai::all();
        $pegawai_nip = null;
        if(isset($pembatalan->pegawais))
        {
            $pegawai_nip = $pembatalan->pegawais->nip;
        }
        return view('pembatalan.upload',compact('pembatalan','pegawais','pegawai_nip'));
        //
    }
}
