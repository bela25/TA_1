<?php

namespace App\Http\Controllers;

use App\Arah_unit;
use Illuminate\Http\Request;

class ArahUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arah_units=Arah_unit::all();
        return view('arah_unit.index',compact('arah_units')); 
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('arah_unit.create');
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
        $post = new Arah_unit();
        $post ->pemandangan = $request->get('pemandangan');
        $post->save();
        return redirect('arah_units');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arah_unit  $arah_unit
     * @return \Illuminate\Http\Response
     */
    public function show(Arah_unit $arah_unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arah_unit  $arah_unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Arah_unit $arah_unit)
    {
        return view('arah_unit.update',compact('arah_unit'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arah_unit  $arah_unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arah_unit $arah_unit)
    {
        $arah_unit ->pemandangan = $request->get('pemandangan');
        $arah_unit->save();
        return redirect('arah_units');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arah_unit  $arah_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arah_unit $arah_unit)
    {
        $arah_unit->delete();
        return redirect('arah_units');
        //
    }
}
