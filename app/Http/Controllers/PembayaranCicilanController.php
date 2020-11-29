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
        $post ->nominal = $request->get('nominal');
        $post ->cicilan_ke = $request->get('cicilan_ke');
        $post ->tenggat_waktu = $request->get('tenggat_waktu');
        $post ->cicilan_terakhir = $request->get('cicilan_terakhir');
        // $post ->tanggal_bayar = $request->get('tanggalpembayaran');
        // $post ->gambar_bukticicilan= $request->get('exampleInputFile');
        $post->save();
        return redirect('cicilans/'.$request->get('kodecicilan'));
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
        $pembayaranCicilan ->cicilan = $request->get('kodecicilan');
        $pembayaranCicilan ->nominal = $request->get('nominal');
        $pembayaranCicilan ->cicilan_ke = $request->get('cicilan_ke');
        $pembayaranCicilan ->tenggat_waktu = $request->get('tenggat_waktu');
        $pembayaranCicilan ->cicilan_terakhir = $request->get('cicilan_terakhir');
        $pembayaranCicilan->save();
        return redirect('cicilans/'.$request->get('kodecicilan'));
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
        $pembayaranCicilan->delete();
        return redirect('cicilans/'.$cicilan);
        //
    }
}
