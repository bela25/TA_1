<?php

namespace App\Http\Controllers;

use App\Tipe_unit;
use Illuminate\Http\Request;

class TipeUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tipe_units=Tipe_unit::all();
        return view('tipe_unit.index',compact('tipe_units'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('tipe_unit.create');
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
        $post = new Tipe_unit();
        $post ->nama = $request->get('namatipe');
        $post ->fasilitas = $request->get('fasilitas');
        $post->save();
        return redirect('tipe_units');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipe_unit  $tipe_unit
     * @return \Illuminate\Http\Response
     */
    public function show(Tipe_unit $tipe_unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipe_unit  $tipe_unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipe_unit $tipe_unit)
    {
        return view('tipe_unit.update',compact('tipe_unit'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipe_unit  $tipe_unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipe_unit $tipe_unit)
    {
       
        $tipe_unit ->nama = $request->get('namatipe');
        $tipe_unit ->fasilitas = $request->get('fasilitas');
        $tipe_unit->save();
        return redirect('tipe_units');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipe_unit  $tipe_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipe_unit $tipe_unit)
    {
        $tipe_unit->delete();
        return redirect('tipe_units');
        //
    }
}
