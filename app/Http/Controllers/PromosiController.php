<?php

namespace App\Http\Controllers;

use App\Promosi;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Lokasi;

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
        $lokasi=Lokasi::all();
        return view('promosi.create',compact('pegawai','lokasi'));
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
        $post ->pegawai = $request->get('admin');
        $post ->lokasi = $request->get('lokasi');

        if(isset($request->gambar))
        {
            $file = $request->file('gambar');
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $post ->gambar = $nama_gambar;
        }
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
        $pegawai=Pegawai::all();
        $lokasi=Lokasi::all();
        return view('promosi.update',compact('promosi','pegawai','lokasi'));
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
        $promosi ->judul_promosi = $request->get('judulpromosi');
        $promosi ->tgl_awal = $request->get('tglawal');
        $promosi ->tgl_akhir = $request->get('tglakhir');
        $promosi ->keterangan = $request->get('keterangan');
        $promosi ->pegawai = $request->get('admin');
        $promosi ->lokasi = $request->get('lokasi');

        $file = $request->file('gambar');
        if(isset($file))
        {
            if(isset($promosi->gambar))
            {
                // unlink(public_path($promosi->gambar));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $promosi ->gambar = $nama_gambar;
        }
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
