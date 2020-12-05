<?php

namespace App\Http\Controllers;

use App\PembayaranCicilan;
use App\Cicilan;
use App\Transaksi;
use Illuminate\Http\Request;

class PembayaranCicilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran_cicilans=PembayaranCicilan::all();
        return view ('pembayaran_cicilan.index',compact('pembayaran_cicilans'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $transaksi = Transaksi::find($request->transaksi);
        $cicilan= Cicilan::all();
        return view('pembayaran_cicilan.create',compact('cicilan','transaksi'));
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
        $transaksi = Transaksi::find($request->transaksi);
        $cicilan = $transaksi->cicilans;
        if($cicilan == null)
        {
            $cicilan = new Cicilan();
            $cicilan ->transaksi = $request->get('transaksi');
            $cicilan ->tanggal_mulai = $request->get('tanggal_mulai');
            $cicilan ->bunga = $request->get('bunga');
        }
        $cicilan ->tanggal_akhir = $request->get('tenggat_waktu');
        $cicilan->save();
        
        $post = new PembayaranCicilan();
        $post ->cicilan = $cicilan->id_cicilan;
        $post ->nominal = str_replace(',','',$request->get('nominal'));
        $post ->cicilan_ke = $request->get('cicilan_ke');
        $post ->tenggat_waktu = $request->get('tenggat_waktu');
        $post ->cicilan_terakhir = $request->get('cicilan_terakhir');
        // $post ->tanggal_bayar = $request->get('tanggalpembayaran');
        // $post ->gambar_bukticicilan= $request->get('exampleInputFile');
        $post->save();
        // return redirect('cicilans/'.$request->get('kodecicilan'));
        return redirect('transaksis/'.$transaksi->id_transaksi);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PembayaranCicilan  $pembayaranCicilan
     * @return \Illuminate\Http\Response
     */
    public function show(PembayaranCicilan $pembayaranCicilan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PembayaranCicilan  $pembayaranCicilan
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranCicilan $pembayaranCicilan)
    {
        $cicilan= Cicilan::all();
        return view('pembayaran_cicilan.update',compact('pembayaranCicilan','cicilan'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PembayaranCicilan  $pembayaranCicilan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranCicilan $pembayaranCicilan)
    {
        // $pembayaranCicilan ->cicilan = $request->get('kodecicilan');
        $pembayaranCicilan ->nominal = $request->get('nominal');
        $pembayaranCicilan ->cicilan_ke = $request->get('cicilan_ke');
        $pembayaranCicilan ->tenggat_waktu = $request->get('tenggat_waktu');
        $pembayaranCicilan ->cicilan_terakhir = $request->get('cicilan_terakhir');
        $pembayaranCicilan->save();

        // update tanggal akhir cicilan
        $cicilan = $pembayaranCicilan->cicilans;
        $cicilan ->tanggal_akhir = $request->get('tenggat_waktu');
        $cicilan->save();
        $transaksi = $pembayaranCicilan->cicilans->transaksis;
        // return redirect('cicilans/'.$request->get('kodecicilan'));
        return redirect('transaksis/'.$transaksi->id_transaksi);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PembayaranCicilan  $pembayaranCicilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranCicilan $pembayaranCicilan)
    {
        $cicilan=$pembayaranCicilan->cicilan;
        $transaksi = $pembayaranCicilan->cicilans->transaksis;
        $pembayaranCicilan->delete();
        // return redirect('cicilans/'.$cicilan);
        return redirect('transaksis/'.$transaksi->id_transaksi);
        //
    }

    public function verifikasi(Request $request, PembayaranCicilan $pembayaranCicilan)
    {
        $pembayaranCicilan->verifikasi = $request->verifikasi;
        $pembayaranCicilan->save();
        return redirect('transaksis/'.$pembayaranCicilan->cicilans->transaksis->id_transaksi);
    }
}
