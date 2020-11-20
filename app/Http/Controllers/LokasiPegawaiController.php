<?php

namespace App\Http\Controllers;

use App\LokasiPegawai;
use App\Lokasi;
use App\Pegawai;
use Illuminate\Http\Request;

class LokasiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasipegawais=LokasiPegawai::all();
        return view('lokasipegawai.index', compact('lokasipegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasis=Lokasi::all();
        $pegawais=Pegawai::all();
        return view('lokasipegawai.create',compact('lokasis','pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lokasipegawai=new LokasiPegawai();
        $lokasipegawai->lokasi=$request->get('lokasi');
        $lokasipegawai->pegawai=$request->get('pegawai');
        $lokasipegawai->save();
        return redirect('lokasipegawais');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LokasiPegawai  $lokasiPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiPegawai $lokasipegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LokasiPegawai  $lokasiPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiPegawai $lokasipegawai)
    {
        $lokasis=Lokasi::all();
        $pegawais=Pegawai::all();
        return view('lokasipegawai.update', compact('lokasipegawai','lokasis','pegawais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LokasiPegawai  $lokasiPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LokasiPegawai $lokasipegawai)
    {
        $lokasipegawai->lokasi=$request->get('lokasi');
        $lokasipegawai->pegawai=$request->get('pegawai');
        $lokasipegawai->save();
        return redirect('lokasipegawais');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LokasiPegawai  $lokasiPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiPegawai $lokasipegawai)
    {
        $lokasipegawai->delete();
        return redirect('lokasipegawais');
    }
}
