<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $lokasis=lokasi::all();
        return view('lokasi.index',compact('lokasis')); 
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       return view('lokasi.create'); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Lokasi();
        $post ->nama_apartemen = $request->get('namaapartemen');
        $post ->provinsi = $request->get('namaprovinsi');
        $post ->kota = $request->get('namakota');
        $post ->alamat = $request->get('namaalamat');
        $post->save();
        return redirect('lokasis');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.update',compact('lokasi'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        
        $lokasi ->nama_apartemen = $request->get('namaapartemen');
        $lokasi ->provinsi = $request->get('namaprovinsi');
        $lokasi ->kota = $request->get('namakota');
        $lokasi ->alamat = $request->get('namaalamat');
        $lokasi->save();
        return redirect('lokasis');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
       $lokasi->delete();
       return redirect('lokasis');
        //
    }
}
