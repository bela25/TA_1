<?php

namespace App\Http\Controllers;

use App\Promosi;
use Illuminate\Http\Request;
use App\Pegawai;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promosis=Promosi::all();
        return view('promosi.index',compact('promosis'));
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
        return view('promosi.create',compact('pegawai'));
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
        $post = new Promosi();
        $post ->judul_promosi = $request->get('judulpromosi');
        $post ->tgl_awal = $request->get('tglawal');
        $post ->tgl_akhir = $request->get('tglakhir');
        $post ->keterangan = $request->get('keterangan');
        $post ->gambar = $request->get('gambar');
        $post ->admin = $request->get('admin');
        $post->save();
        return redirect('promosis');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promoosi  $promoosi
     * @return \Illuminate\Http\Response
     */
    public function show(Promosi $promosi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promoosi  $promoosi
     * @return \Illuminate\Http\Response
     */
    public function edit(Promosi $promosi)
    {
        return view('promosi.update',compact('promosi'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promoosi  $promoosi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promosi $promosi)
    {
        $post ->judul_promosi = $request->get('judulpromosi');
        $post ->tgl_awal = $request->get('tglawal');
        $post ->tgl_akhir = $request->get('tglakhir');
        $post ->keterangan = $request->get('keterangan');
        $post ->gambar = $request->get('gambar');
        $post ->admin = $request->get('admin');
        $promosi->save();
        return redirect('promosis');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promoosi  $promoosi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promosi $promosi)
    {
        
        $promosi->delete();
        return redirect('promosis');//
    }
}
