<?php

namespace App\Http\Controllers;

use App\GambarProduk;
use Illuminate\Http\Request;
use App\Tipe_unit;

class GambarProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gambar_produks=GambarProduk::all();
        return view('gambar_produk.index',compact('gambar_produks')); 
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipe_unit=Tipe_unit::all();
        return view('gambar_produk.create',compact('tipe_unit'));
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
        $file = $request->file('file_gambar');
        $nama_gambar = $file->move('Image/', $file->getClientOriginalName());

        $post = new GambarProduk();
        $post ->nama_gambar = $nama_gambar;
        $post ->tipe = $request->get('tipe');
        $post->save();
        return redirect('gambar_produks');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function show(GambarProduk $gambarProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarProduk $gambarProduk)
    {
        $tipe_unit=Tipe_unit::all();
        return view('gambar_produk.update',compact('gambarProduk','tipe_unit'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarProduk $gambarProduk)
    {
        $file = $request->file('file_gambar');
        if(isset($file))
        {
            if(isset($gambarProduk->nama_gambar))
            {
                unlink(public_path($gambarProduk->nama_gambar));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $gambarProduk ->nama_gambar = $nama_gambar;
        }

        $gambarProduk ->tipe = $request->get('tipe');
        $gambarProduk->save();
        return redirect('gambar_produks');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarProduk $gambarProduk)
    {
        unlink($gambarProduk->nama_gambar);
        $gambarProduk->delete();
        return redirect('gambar_produks');
        //
    }
}
