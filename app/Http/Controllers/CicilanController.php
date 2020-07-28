<?php

namespace App\Http\Controllers;

use App\Cicilan;
use Illuminate\Http\Request;
use App\Transaksi;

class CicilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cicilans = Cicilan::all();
        return view('cicilan.index',compact('cicilans'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksi=Transaksi::all();
        return view('cicilan.create',compact('transaksi'));
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
        $post = new Cicilan();
        $post ->transaksi = $request->get('transaksi');
        $post ->tanggal_mulai = $request->get('tglawal');
        $post ->tanggal_akhir = $request->get('tglakhir');
        $post ->bunga = $request->get('bunga');
        $post->save();
        return redirect('cicilans');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function show(Cicilan $cicilan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function edit(Cicilan $cicilan)
    {
       return view('cicilan.update',compact('cicilan'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cicilan $cicilan)
    {
        $cicilan ->transaksi = $request->get('transaksi');
        $cicilan ->tanggal_mulai = $request->get('tglawal');
        $cicilan ->tanggal_akhir = $request->get('tglakhir');
        $cicilan ->bunga = $request->get('bunga');
        $cicilan->save();
        return redirect('cicilans');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cicilan $cicilan)
    {
        $cicilan->delete();
        return redirect('cicilans');
        //
    }
}
