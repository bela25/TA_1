<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais=Pegawai::all();
        return view('pegawai.index',compact('pegawais'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view ('pegawai.create');
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
        $post = new Pegawai();
        $post ->nama = $request->get('nama');
        $post ->alamat = $request->get('alamat');
        $post ->tempat_lahir = $request->get('tempatllahir');
        $post ->nip = $request->get('nip');
        $post ->tgl_lahir = $request->get('tgllahir');
        $post ->no_telp =$request->get('notelp');
        $post ->jabatan = $request->get('jabatan');
        $post ->email = $request->get('email');
        $post ->username= $request->get('username');
        $post ->password = $request->get('password');
        $post ->tgl_bergabung = $request->get('tglbergabung');
        $post->save();
        return redirect('pegawais');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
       return view('pegawai.update',compact('pegawai'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $pegawai ->nama = $request->get('nama');
        $pegawai ->alamat = $request->get('alamat');
        $pegawai ->tempat_lahir = $request->get('tempatllahir');
        $pegawai ->nip = $request->get('nip');
        $pegawai ->tgl_lahir = $request->get('tgllahir');
        $pegawai ->no_telp =$request->get('notelp');
        $pegawai ->jabatan = $request->get('jabatan');
        $pegawai ->email = $request->get('email');
        $pegawai ->username= $request->get('username');
        $pegawai ->password = $request->get('password');
        $pegawai ->tgl_bergabung = $request->get('tglbergabung');
        $pegawai->save();
        return redirect('pegawais');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        
        $pegawai->delete();
       return redirect('pegawais');//
    }
}
