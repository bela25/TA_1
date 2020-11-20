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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->get('nama');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $post = new Pegawai();
        $post ->nama = $request->get('nama');
        $post ->alamat = $request->get('alamat');
        $post ->tempat_lahir = $request->get('tempatlahir');
        $post ->nip = $request->get('nip');
        $post ->tgl_lahir = $request->get('tgllahir');
        $post ->no_telp =$request->get('notelp');
        $post ->jabatan = $request->get('jabatan');
        $post ->tgl_bergabung = $request->get('tglbergabung');
        $post ->user_id = $user->id;
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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user->name = $request->get('nama');
        $user->email = $request->get('email');
        $user->save();

        $pegawai ->nama = $request->get('nama');
        $pegawai ->alamat = $request->get('alamat');
        $pegawai ->tempat_lahir = $request->get('tempatlahir');
        // $pegawai ->nip = $request->get('nip');
        $pegawai ->tgl_lahir = $request->get('tgllahir');
        $pegawai ->no_telp =$request->get('notelp');
        $pegawai ->jabatan = $request->get('jabatan');
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
        $user = $pegawai->user;
        $pegawai->delete();
        $user->delete();
        return redirect('pegawais');//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function ubahprofil(Pegawai $pegawai)
    {
        return view('pegawai.ubahprofil',compact('pegawai'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function simpanprofil(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user->name = $request->get('nama');
        $user->email = $request->get('email');
        $user->save();

        $pegawai ->nama = $request->get('nama');
        $pegawai ->alamat = $request->get('alamat');
        $pegawai ->tempat_lahir = $request->get('tempatlahir');
        // $pegawai ->nip = $request->get('nip');
        $pegawai ->tgl_lahir = $request->get('tgllahir');
        $pegawai ->no_telp =$request->get('notelp');
        $pegawai ->jabatan = $request->get('jabatan');
        $pegawai ->tgl_bergabung = $request->get('tglbergabung');
        $pegawai->save();
        return redirect('pegawais/'.$pegawai->nip.'/ubahprofil');
        //
    }
}
