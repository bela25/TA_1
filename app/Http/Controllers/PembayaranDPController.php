<?php

namespace App\Http\Controllers;

use App\PembayaranDP;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Notifikasi;
use Carbon\Carbon;

class PembayaranDPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran_dps= PembayaranDP::all();
        return view('pembayaran_dp.index',compact('pembayaran_dps'));
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
        return view('pembayaran_dp.index',compact('transaksi'));
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
        $pembayaranDP = PembayaranDP::where('transaksi',$request->get('transaksi'))->get();
        if($pembayaranDP->count() <= 0)
        {
            $post = new PembayaranDP();
            $post ->tanggal_bayar = Carbon::now();
            $post ->nominal = $request->get('nominal');
            $post ->transaksi = $request->get('transaksi');
            // upload bukti
            if(isset($request->bukti))
            {
                $file = $request->file('bukti');
                $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
                $post ->gambar_bukti= $nama_gambar;
                $post->save();

                $namaNotif = 'DP Transaksi '.$transaksi->id_transaksi;
                $notif = new Notifikasi();
                $notif->nama = $namaNotif;
                $notif->pesan = $namaNotif.' dibayar';
                $notif->dibaca = 'belum';
                $notif->pegawai = $transaksi->pegawais->nip;
                $notif->save();
                request()->session()->flash('pesan','Bukti pembayaran DP tersimpan');
            }
            else
            {
                request()->session()->flash('pesan','Anda belum memilih gambar');
            }
        }
        else
        {
            request()->session()->flash('pesan','Anda sudah mengirim bukti pembayaran DP');   
        }
        return redirect()->route('pengunjung.dp',$transaksi->unit);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function show(PembayaranDP $pembayaran_dp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranDP $pembayaran_dp)
    {
        $pembayaranDP = $pembayaran_dp;
        return view('pembayaran_dp.update',compact('pembayaranDP'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranDP $pembayaran_dp)
    {
        $pembayaranDP = $pembayaran_dp;
        $transaksi = Transaksi::find($request->get('transaksi'));
        // $pembayaran_dp = PembayaranDP::where('transaksi',$request->get('transaksi'))->get();
        
        $pembayaranDP ->tanggal_bayar = Carbon::now();
        $pembayaranDP ->nominal = $request->get('nominal');
        $pembayaranDP ->transaksi = $request->get('transaksi');
        // upload bukti
        $file = $request->file('bukti');
        if(isset($file))
        {
            if(isset($pembayaranDP->gambar_bukti))
            {
                unlink(public_path($pembayaranDP->gambar_bukti));
            }
            $nama_gambar = $file->move('Image/', $file->getClientOriginalName());
            $pembayaranDP ->gambar_bukti= $nama_gambar;
        }
        $pembayaranDP->save();

        $namaNotif = 'DP Transaksi '.$pembayaranCicilan->cicilans->transaksi;
        $notif = new Notifikasi();
        $notif->nama = $namaNotif;
        $notif->pesan = $namaNotif.' gambar bukti diganti';
        $notif->dibaca = 'belum';
        $notif->pegawai = $pembayaranCicilan->cicilans->transaksis->pegawais->nip;
        $notif->save();
        request()->session()->flash('pesan','Bukti pembayaran DP tersimpan');
        return redirect()->route('pengunjung.dp',$transaksi->unit);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PembayaranDP  $pembayaranDP
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranDP $pembayaran_dp)
    {
        $pembayaran_dp->delete();
        return redirect('pembayaran_dps');
        //
    }

    public function verifikasi(Request $request, PembayaranDp $pembayaranDp)
    {
        $pembayaranDp->verifikasi = $request->verifikasi;
        $pembayaranDp->save();
        if($request->verifikasi== 'diterima')
        {
            $pembayaranDp->transaksis->units->status = 'terjual';
            $pembayaranDp->transaksis->units->save();
        }

        $namaNotif = 'DP Unit '.$pembayaranDp->transaksis->units->nama();
        $notif = new Notifikasi();
        $notif->nama = $namaNotif;
        $notif->pesan = $namaNotif.' pembayaran '.$request->verifikasi;
        $notif->dibaca = 'belum';
        $notif->customer = $pembayaranDp->transaksis->customers->idcustomers;
        $notif->save();
        return redirect('transaksis/'.$pembayaranDp->transaksis->id_transaksi);
    }
}
