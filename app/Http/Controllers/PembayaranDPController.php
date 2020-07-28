<?php

namespace App\Http\Controllers;

use App\PembayaranDP;
use Illuminate\Http\Request;
use App\Transaksi;

class PembayaranDPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran_dps= PembayaranDP::all();
        return view('pembayaran_dp.index',compact('pembayaran_dps'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksi= Transaksi::all();
        return view('pembayaran_dp.index',compact('transaksi'));
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
        $post = new PembayaranDP();
        $post ->transaksi = $request->get('customer');
        $post ->tanggal_bayar = $request->get('tanggalpembayaran');
        $post ->nominal = $request->get('nominal');
        $post ->gambar_bukti= $request->get('exampleInputFile');
        $post->save();
        return redirect('pembayaran_dps');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function show(PembayaranDP $pembayaranDP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranDP $pembayaranDP)
    {
         return view('pembayaran_dp.update',compact('pembayaran_dp'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranDP $pembayaranDP)
    {
        $pembayaran_dp ->transaksi = $request->get('customer');
        $pembayaran_dp ->tanggal_bayar = $request->get('tanggalpembayaran');
        $pembayaran_dp ->nominal = $request->get('nominal');
        $pembayaran_dp ->gambar_bukti= $request->get('exampleInputFile');
        $pembayaran_dp->save();
        return redirect('pembayaran_dps');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranDP $pembayaranDP)
    {
        $pembayaran_dp->delete();
        return redirect('pembayaran_dps');
        //
    }
}
