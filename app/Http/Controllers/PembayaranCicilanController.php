<?php

namespace App\Http\Controllers;

use App\PembayaranCicilan;
use Illuminate\Http\Request;
use App\Cicilan;

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
    public function create()
    {
        $cicilan= Cicilan::all();
        return view('pembayaran_cicilan.create',compact('cicilan'));
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
        $post = new PembayaranCicilan();
        $post ->cicilan = $request->get('kodecicilan');
        $post ->tanggal_bayar = $request->get('tanggalpembayaran');
        $post ->nominal = $request->get('nominal');
        $post ->gambar_bukticicilan= $request->get('exampleInputFile');
        $post->save();
        return redirect('pembayaran_cicilans');
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
        return view('pembayaran_cicilan.update',compact('pembayaran_cicilan'));
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
        $pembayaran_cicilan ->no_unit = $request->get('namaunit');
        $pembayaran_cicilan ->tanggal_bayar = $request->get('tanggalpembayaran');
        $pembayaran_cicilan ->nominal = $request->get('nominal');
        $pembayaran_cicilan ->gambar_bukticicilan= $request->get('exampleInputFile');
        $pembayaran_cicilan->save();
        return redirect('pembayaran_cicilans');
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
        $pembayaran_cicilan->delete();
        return redirect('pembayaran_cicilans');
        //
    }
}
