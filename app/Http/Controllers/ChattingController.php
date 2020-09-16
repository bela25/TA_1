<?php

namespace App\Http\Controllers;

use App\Chatting;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Customer;

class ChattingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chattings=Chatting::all();
        return view('chatting.index',compact('chattings'));
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
        $customer=Customer::all();
        return view('chatting.create',compact('pegawai'));
        return view('chatting.create',compact('customer'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chatting  $chatting
     * @return \Illuminate\Http\Response
     */
    public function show(Chatting $chatting)
    {
        $post = new Chatting();
        $post ->pesan = $request->get('pesan');
        $post ->tgl_pesan = $request->get('tglpesan');
        $post ->pegawai = $request->get('admin');
        $post ->customer = $request->get('customer');
        $post->save();
        return redirect('chattings');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chatting  $chatting
     * @return \Illuminate\Http\Response
     */
    public function edit(Chatting $chatting)
    {
        return view('chatting.update',compact('chatting'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chatting  $chatting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chatting $chatting)
    {
       
        $chatting ->pesan = $request->get('pesan');
        $chatting ->tgl_pesan = $request->get('tglpesan');
        $chatting ->pegawai = $request->get('admin');
        $chatting ->customer = $request->get('customer');
        $chatting->save();
        return redirect('chattings');
       
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chatting  $chatting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chatting $chatting)
    {
        $chatting->delete();
        return redirect('chattings');
        //
    }
}
