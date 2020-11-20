<?php

namespace App\Http\Controllers;

use App\Spesifikasi_bangunan;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Lokasi;

class SpesifikasiBangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spesifikasi_bangunans=Spesifikasi_bangunan::all();
        return view('spesifikasi_bangunan.index',compact('spesifikasi_bangunans'));
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
        $lokasi=Lokasi::all();
        return view('spesifikasi_bangunan.create',compact('pegawai','lokasi'));
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
        $post = new Spesifikasi_bangunan();
        $post ->lantai = $request->get('lantai');
        $post ->dinding = $request->get('dinding');
        $post ->platfon = $request->get('platfon');
        $post ->instalasi_listrik = $request->get('instalasilistrik');
        $post ->sanitary = $request->get('sanitary');
        $post ->pintu = $request->get('pintu');
        $post ->jendela = $request->get('jendela');
        $post ->air= $request->get('air');
        $post ->pegawai = $request->get('admin');
        $post ->lokasi = $request->get('lokasi');
        $post->save();
        return redirect('spesifikasi_bangunans');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spesifikasi_bangunan  $spesifikasi_bangunan
     * @return \Illuminate\Http\Response
     */
    public function show(Spesifikasi_bangunan $spesifikasi_bangunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spesifikasi_bangunan  $spesifikasi_bangunan
     * @return \Illuminate\Http\Response
     */
    public function edit(Spesifikasi_bangunan $spesifikasi_bangunan)
    {
        $pegawai=Pegawai::all();
        $lokasi=Lokasi::all();
        return view('spesifikasi_bangunan.update',compact('spesifikasi_bangunan','pegawai','lokasi'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spesifikasi_bangunan  $spesifikasi_bangunan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spesifikasi_bangunan $spesifikasi_bangunan)
    {
        $spesifikasi_bangunan ->lantai = $request->get('lantai');
        $spesifikasi_bangunan ->dinding = $request->get('dinding');
        $spesifikasi_bangunan ->platfon = $request->get('platfon');
        $spesifikasi_bangunan ->instalasi_listrik = $request->get('instalasilistrik');
        $spesifikasi_bangunan ->sanitary = $request->get('sanitary');
        $spesifikasi_bangunan ->pintu = $request->get('pintu');
        $spesifikasi_bangunan ->jendela = $request->get('jendela');
        $spesifikasi_bangunan ->air= $request->get('air');
        $spesifikasi_bangunan ->pegawai = $request->get('admin');
        $spesifikasi_bangunan ->lokasi = $request->get('lokasi');
        $spesifikasi_bangunan->save();
        return redirect('spesifikasi_bangunans');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spesifikasi_bangunan  $spesifikasi_bangunan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spesifikasi_bangunan $spesifikasi_bangunan)
    {
        $spesifikasi_bangunan->delete();
        return redirect('spesifikasi_bangunans');
        //
    }
}
