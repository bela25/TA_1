<?php

namespace App\Http\Controllers;

use App\Profil;
use Illuminate\Http\Request;
use App\Pegawai;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profils=Profil::all();
        return view('profil.index',compact('profils')); 
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai =Pegawai::all();
        return view('profil.create',compact('pegawai'));
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
        $post = new Profil();
        $post ->judul_profil = $request->get('judulprofil');
        $post ->tgl = $request->get('tgldibuat');
        $post ->keterangan = $request->get('keterangan');
        $post ->gambar = $request->get('gambar');
        $post ->admin = $request->get('admin');
        $post->save();
        return redirect('profils');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit(Profil $profil)
    {
        return view('profil.update',compact('profil'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profil)
    {
        $profil ->judul_profil = $request->get('judulprofil');
        $profil ->tgl = $request->get('tgldibuat');
        $profil ->keterangan = $request->get('keterangan');
        $profil ->gambar = $request->get('gambar');
        $profil ->admin = $request->get('admin');
        $profil->save();
        return redirect('profils');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        $profil->delete();
        return redirect('profils');
        //
    }
}
