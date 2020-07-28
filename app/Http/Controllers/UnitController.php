<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Tower;
use App\Arah_unit;
use App\Tipe_unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $units = Unit::all();
       return view('unit.index',compact('units'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tower= Tower::all();
        $arah_unit=Arah_unit::all();
        $tipe_unit=Tipe_unit::all();
        return view('unit.create',compact('tower','arah_unit','tipe_unit'));
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
        $post = new Unit();
        $post ->cicilan = $request->get('kodecicilan');
        $post ->lantai = $request->get('lantai');
        $post ->status = $request->get('customRadio');
        $post ->tower = $request->get('tower');
        $post ->arah= $request->get('arah');
        $post ->tipe = $request->get('tipeunit');
        $post->save();
        return redirect('units');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        
        return view('unit.update',compact('unit'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $unit ->no_unit = $request->get('namaunit');
        $unit ->lantai = $request->get('lantai');
        $unit ->status = $request->get('customRadio');
        $unit ->tower = $request->get('tower');
        $unit ->arah= $request->get('arah');
        $unit ->tipe = $request->get('tipeunit');
        $unit->save();
        return redirect('units');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect('units');
        //
    }
}
