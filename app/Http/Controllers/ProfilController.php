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
        // dd($profils[0]->pegawais);
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
        // $post ->tgl = $request->get('tgldibuat');
        // $post ->admin = $request->get('admin');
        $post ->admin = auth()->user()->pegawai->nip;
        $post ->judul_profil = $request->get('judulprofil');
        $post ->keterangan = $request->get('keterangan');
        if($request->file('gambar') != null)
        {
            $post ->gambar = $request->get('gambar');
        }
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
        $pegawai=Pegawai::all();
        return view('profil.update',compact('profil','pegawai'));
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
        // $profil ->tgl = $request->get('tgldibuat');
        // $profil ->admin = $request->get('admin');
        $profil ->admin = auth()->user()->pegawai->nip;
        $profil ->judul_profil = $request->get('judulprofil');
        $profil ->keterangan = $request->get('keterangan');
        if($request->file('gambar') != null)
        {
            $profil ->gambar = $request->get('gambar');
        }
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
