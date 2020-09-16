<?php

namespace App\Http\Controllers;

use App\Tower;
use Illuminate\Http\Request;
use App\Lokasi;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towers=Tower::all();
        return view('tower.index',compact('towers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasi= Lokasi::all();
        return view('tower.create',compact('lokasi'));
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
        $post = new Tower();
        $post ->nama = $request->get('nama');
        $post ->keterangan = $request->get('keterangan');
        $post ->lokasi = $request->get('lokasi');
        $post->save();
        return redirect('towers');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function show(Tower $tower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function edit(Tower $tower)
    {
        $lokasi= Lokasi::all();
        return view('tower.update',compact('tower','lokasi'));//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tower $tower)
    {
        $tower ->nama = $request->get('nama');
        $tower ->keterangan = $request->get('keterangan');
        $tower ->lokasi = $request->get('lokasi');
        $tower->save();
        return redirect('towers');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tower $tower)
    {
        $tower->delete();
        return redirect('towers');
        //
    }
}
