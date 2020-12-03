<?php

namespace App\Http\Controllers;

use App\PembayaranBooking;
use Illuminate\Http\Request;
use App\Transaksi;
use Carbon\Carbon;

class PembayaranBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran_bookings= PembayaranBooking::all();
        return view('pembayaran_booking.index',compact('pembayaran_bookings'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksi= Transaksi::all();
        return view('pembayaran_booking.index',compact('transaksi'));
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
        $transaksi = Transaksi::find($request->get('transaksi'));
        $pembayaranBooking = PembayaranBooking::where('transaksi',$request->get('transaksi'))->get();
        if($pembayaranBooking->count() <= 0)
        {
            $post = new PembayaranBooking();
            $post ->tanggal_bayar = Carbon::now();
            $post ->nominal = $request->get('nominal');
            $post ->transaksi = $request->get('transaksi');
            // upload bukti
            $file = $request->file('bukti');
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $post ->gambar_bukti= $nama_gambar;
            $post->save();
            request()->session()->flash('pesan','Bukti pembayaran booking tersimpan');
        }
        else
        {
            request()->session()->flash('pesan','Anda sudah mengirim bukti pembayaran booking');   
        }
        return redirect()->route('pengunjung.booking',$transaksi->unit);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PembayaranBooking  $pembayaranBooking
     * @return \Illuminate\Http\Response
     */
    public function show(PembayaranBooking $pembayaranBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PembayaranBooking  $pembayaranBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranBooking $pembayaranBooking)
    {
        return view('pembayaran_booking.update',compact('pembayaranBooking'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PembayaranBooking  $pembayaranBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranBooking $pembayaranBooking)
    {
        $transaksi = Transaksi::find($request->get('transaksi'));
        // $pembayaranBooking = PembayaranBooking::where('transaksi',$request->get('transaksi'))->get();
        
        $pembayaranBooking ->tanggal_bayar = Carbon::now();
        $pembayaranBooking ->nominal = $request->get('nominal');
        $pembayaranBooking ->transaksi = $request->get('transaksi');
        // upload bukti
        $file = $request->file('bukti');
        if(isset($file))
        {
            if(isset($pembayaranBooking->gambar_bukti))
            {
                unlink(public_path($pembayaranBooking->gambar_bukti));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $pembayaranBooking ->gambar_bukti= $nama_gambar;
        }
        $pembayaranBooking->save();
        request()->session()->flash('pesan','Bukti pembayaran booking tersimpan');
        return redirect()->route('pengunjung.booking',$transaksi->unit);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PembayaranBooking  $pembayaranBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranBooking $pembayaranBooking)
    {
        $pembayaranBooking->delete();
        return redirect('pembayaran_bookings');
        //
    }

    public function verifikasi(Request $request, PembayaranBooking $pembayaranBooking)
    {
        $pembayaranBooking->verifikasi = $request->verifikasi;
        $pembayaranBooking->save();
        return redirect('transaksis/'.$pembayaranBooking->transaksis->id_transaksi);
    }
}
