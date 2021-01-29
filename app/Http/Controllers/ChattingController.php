<?php

namespace App\Http\Controllers;

use App\Chatting;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Customer;
use App\Notifikasi;
use App\Unit;
use Carbon\Carbon;

class ChattingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers=Customer::all();
        $customer=Customer::first();
        // $units=Unit::all();
        // $unit=Unit::first();
        if(count($request->all()) > 0)
        {
            $customer = Customer::find($request->get('customer'));
            $unit_ids = $customer->chats->unique('unit')->pluck('unit');
            $units = Unit::whereIn('id_unit', $unit_ids)->get();
            $unit = Unit::find($request->get('unit')) ?? $units->first();
        }
        $chattings=Chatting::where('customer', $customer->idcustomers)->get();
        if($unit != null) {
            $chattings = $chattings->where('unit', $unit->id_unit);
        }
        return view('chatting.index',compact('chattings','customers','customer','units','unit'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $pegawai=Pegawai::all();
        // $customer=Customer::all();
        // return view('chatting.create',compact('customer','pegawai'));
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
        $pegawai = auth()->user()->pegawai;
        $customer = Customer::find($request->get('customer'));
        $post = new Chatting();
        $post ->pesan = $request->get('pesan');
        $post ->tgl_pesan = Carbon::now();
        $post ->pegawai = $pegawai->nip;
        $post ->customer = $customer->idcustomers;
        $post ->unit = $request->get('unit');
        $post->save();

        $namaNotif = 'Chat '.$chat->id_chat;
        if(Notifikasi::where('nama', $namaNotif)->count() <= 0)
        {
            $notif = new Notifikasi();
            $notif->nama = $namaNotif;
            $notif->pesan = $namaNotif.'. Unit: '.Unit::find($request->get('unit'))->nama();
            $notif->dibaca = 'belum';
            $notif->customer = $customer->idcustomers;
            $notif->save();
        }
        return redirect('chattings');
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
        // return view('chatting.update',compact('chatting'));
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
        // $chatting ->pesan = $request->get('pesan');
        // $chatting ->tgl_pesan = $request->get('tglpesan');
        // $chatting ->pegawai = $request->get('admin');
        // $chatting ->customer = $request->get('customer');
        // $chatting->save();
        // return redirect('chattings');
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
