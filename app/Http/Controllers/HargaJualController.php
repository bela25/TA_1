<?php

namespace App\Http\Controllers;

use App\HargaJual;
use Illuminate\Http\Request;
use App\Tower;
use App\Arah_unit;
use App\Tipe_unit;

class HargaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harga_juals = HargaJual::all();
        return view('harga_jual.index',compact('harga_juals'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tower= Tower::all();
        $arah_unit=Arah_unit::all();
        $tipe_unit=Tipe_unit::all();
        return view('harga_Jual.create',compact('tower','arah_unit','tipe_unit'));
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
        $post = new HargaJual();
        $post ->hargajual_cash = $request->get('hargajual');
        $post ->tgl_awal = $request->get('tglawal');
        $post ->tgl_akhir = $request->get('tglakhir');
        $post ->tower = $request->get('tower');
        $post ->arah= $request->get('arah');
        $post ->tipe = $request->get('tipeunit');
        $post->save();
        return redirect('harga_juals');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HargaJual  $hargaJual
     * @return \Illuminate\Http\Response
     */
    public function show(HargaJual $hargaJual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HargaJual  $hargaJual
     * @return \Illuminate\Http\Response
     */
    public function edit(HargaJual $hargaJual)
    {
         return view('harga_jual.update',compact('harga_jual'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HargaJual  $hargaJual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HargaJual $hargaJual)
    {
        $hargaJual ->hargajual_cash = $request->get('hargajual');
        $hargaJual ->tgl_awal = $request->get('tglawal');
        $hargaJual ->tgl_akhir = $request->get('tglakhir');
        $hargaJual ->tower = $request->get('tower');
        $hargaJual ->arah= $request->get('arah');
        $hargaJual ->tipe = $request->get('tipe');
        $hargaJual->save();
        return redirect('harga_juals');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HargaJual  $hargaJual
     * @return \Illuminate\Http\Response
     */
    public function destroy(HargaJual $hargaJual)
    {
         $harga_jual->delete();
        return redirect('harga_juals');
        //
    }
}
