<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pembatalan extends Model
{
    protected $primaryKey = 'id_pembatalan';

    public function tanggalPengembalian()
    {
        return Carbon::parse($this->tgl_pengembalian)->format('d F Y');   
    }
    public function bulanLunas()
    {
        return Carbon::parse($this->tanggal_batal)->format('F');
    }
    public function tahunLunas()
    {
        return Carbon::parse($this->tanggal_batal)->year;
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','admin','nip');
    }
    public function transaksis()
    {
    	return $this->belongsTo('App\Transaksi','transaksi','id_transaksi');
    }
    public function biayaBatal()
    {
        $nominal = 0;
        if($this->transaksis->pembayarandps != null && $this->transaksis->pembayarandps->gambar_bukti != null && $this->transaksis->pembayarandps->verifikasi == 'diterima')
        {
            $nominal = $this->transaksis->pembayarandps->nominal;
        }
        return $nominal;
    }
    public function nominal()
    {
        // $nominal = [];
        $nominal = 0;
        if($this->transaksis->pembayaranbookings != null && $this->transaksis->pembayaranbookings->gambar_bukti != null && $this->transaksis->pembayaranbookings->verifikasi == 'diterima')
        {
            // $nominal['booking']= $this->transaksis->pembayaranbookings->nominal;
            $nominal+= $this->transaksis->pembayaranbookings->nominal;
        }
        if($this->transaksis->pembayarandps != null && $this->transaksis->pembayarandps->gambar_bukti != null && $this->transaksis->pembayarandps->verifikasi == 'diterima')
        {
            // $nominal['dp']= $this->transaksis->pembayarandps->nominal;
            $nominal+= $this->transaksis->pembayarandps->nominal;
        }
        if($this->transaksis->cicilans != null && $this->transaksis->cicilans->pembayaran_cicilans->count() > 0)
        {
            foreach($this->transaksis->cicilans->pembayaran_cicilans as $pembayaran_cicilan)
            {
                if($pembayaran_cicilan->gambar_bukticicilan != null && $pembayaran_cicilan->verifikasi == 'diterima')
                {
                    // $nominal ['cicilan '.$pembayaran_cicilan->cicilan_ke]= $pembayaran_cicilan->nominal;
                    $nominal+= $pembayaran_cicilan->nominal;
                }
            }
        }
        // return $this->transaksis->units->hargaJualCash() * 80 / 100;
        // dd($nominal);
        return $nominal;
    }
    public function showNominal()
    {
        $nominal = $this->nominal() - $this->biayaBatal();
        return 'Rp'.number_format($nominal,2,',','.');
    }
    public function formatUang($nominal)
    {
        return 'Rp'.number_format($nominal,2,',','.');
    }
    //
}
