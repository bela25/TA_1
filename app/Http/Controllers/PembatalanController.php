<?php

namespace App\Http\Controllers;

use App\Pembatalan;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Pegawai;

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
        $post = new Pembatalan();
        $post ->transaksi = $request->get('customer');
        $post ->alasan = $request->get('alasan');
        $post ->harga_jual = $request->get('hargajual');
        $post ->gambar_bukti = $request->get('exampleInputFile');
        $post ->tgl_pengembalian= $request->get('tglpengembalian');
        $post ->admin = $request->get('admin');
        $post->save();
        return redirect('pembatalans');
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
        $pembatalan ->transaksi = $request->get('customer');
        $pembatalan ->alasan = $request->get('alasan');
        $pembatalan ->harga_jual = $request->get('hargajual');
        $pembatalan ->gambar_bukti = $request->get('exampleInputFile');
        $pembatalan ->tgl_pengembalian= $request->get('tglpengembalian');
        $pembatalan ->admin = $request->get('admin');
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
}
