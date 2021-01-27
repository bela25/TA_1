<?php

namespace App\Http\Controllers;

use App\Chatting;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Customer;
use App\Unit;
use App\LokasiPegawai;
use App\Notifikasi;
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
        if (auth()->user()->pegawai->jabatan == 'admin') {
            $units=Unit::all();
            $unit=Unit::first();
        } else {
            $lokasi=LokasiPegawai::where('pegawai', auth()->user()->pegawai->nip)->first();
            $units=Unit::join('towers', 'tower', 'id_tower')->where('towers.lokasi', $lokasi->lokasi)->get();
            $unit=Unit::join('towers', 'tower', 'id_tower')->where('towers.lokasi', $lokasi->lokasi)->first();
        }
        if(count($request->all()) > 0)
        {
            $customer=Customer::find($request->get('customer'));
            if ($request->get('unit')) {
                $unit=Unit::find($request->get('unit'));
            }
        }
        // dd($customer);
        $chattings=Chatting::where('customer', $customer->idcustomers)->where('unit', $unit->id_unit)->get();
        return view('chatting.index',compact('chattings','customers','customer', 'units', 'unit'));
        // return $lokasi;
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
        $post = new Chatting();
        $post ->pesan = $request->get('pesan');
        $post ->tgl_pesan = Carbon::now();
        $post ->pegawai = auth()->user()->pegawai->nip;
        $post ->customer = $request->get('customer');
        $post ->unit = $request->get('unit');
        $post->save();

        $unit=Unit::where('id_unit', $request->get('unit'))->first();
        $namaNotif = 'Pesan Customer '.$request->get('customer').' pada '.$unit->nama().' - '.$unit->towers->lokasis->nama_apartemen;

        if (Notifikasi::where('nama', $namaNotif)->count() <= 0) {
            $notif = new Notifikasi();
            $notif->nama = $namaNotif;
            $notif->pesan = 'Pesan Baru pada '.$unit->nama().' - '.$unit->towers->lokasis->nama_apartemen;
            $notif->dibaca = 'belum';
            $notif->customer = $request->get('customer');
            $notif->save();
        } else {
            $notif = Notifikasi::where('nama', $namaNotif)->first();
            $notif->dibaca = 'belum';
            $notif->save();
        }

        return redirect()->back();
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
