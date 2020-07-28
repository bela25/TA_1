<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Customer;
use App\Pegawai;
use App\HargaJual;
use App\Unit;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('transaksi.index',compact('transaksis'));
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
        $post = new Transaksi();
        $post ->customer = $request->get('customer');
        $post ->unit = $request->get('unit');
        $post ->tanggal_batal = $request->get('tanggalbatal');
        $post ->jenis_bayar = $request->get('jenisbayar');
        $post ->tanggal= $request->get('tglpembayaran');
        $post ->status = $request->get('customRadio');
        $post ->verifikasi = $request->get('customRadio1');
        $post ->tgl_pelunasan= $request->get('tglpelunasan');
        $post->save();
        return redirect('transaksis');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.update',compact('transaksi'));
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
        $transaksi ->customer = $request->get('customer');
        $transaksi ->unit = $request->get('unit');
        $transaksi ->harga_jual = $request->get('hargajual');
        $transaksi ->jenis_bayar = $request->get('jenisbayar');
        $transaksi ->tanggal= $request->get('tglpembayaran');
        $transaksi ->status = $request->get('customRadio');
        $transaksi ->verifikasi = $request->get('customRadio1');
        $transaksi ->tgl_pelunasan= $request->get('tglpelunasan');
        $transaksi->save();
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
}
