<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Lokasi;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lokasi = Lokasi::find($request->get('lokasi'));
        $lokasis = Lokasi::all();
        return view('berita.create', compact('lokasi','lokasis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Berita();
        $post ->lokasi = $request->get('lokasi');
        $post ->progress = $request->get('progress');
        $post ->tanggal = $request->get('tanggal');
        $post->save();
        return redirect()->route('lokasis.show', $request->get('lokasi'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        $lokasi = $berita->lokasis;
        return view('berita.update', compact('lokasi','berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $berita ->lokasi = $request->get('lokasi');
        $berita ->progress = $request->get('progress');
        $berita ->tanggal = $request->get('tanggal');
        $berita->save();
        return redirect()->route('lokasis.show', $berita->lokasis);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        $lokasi = $berita->lokasis;
        $berita->delete();
        return redirect()->route('lokasis.show', $lokasi);
    }
}
