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
        $post = new GambarProduk();
        $post ->nama_gambar = $request->get('exampleInputFile');
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
        return view('gambar_produk.update',compact('gambar_produk'));
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
         
        $gambar_produk ->nama_gambar = $request->get('exampleInputFile');
        $gambar_produk ->tipe = $request->get('tipe');
        $gambar_produk->save();
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
        $gambar_produk->delete();
        return redirect('gambar_produks');
        //
    }
}
