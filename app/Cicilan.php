<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cicilan extends Model
{
    protected $primaryKey = 'id_cicilan';
   
    public function transaksis()
    {
    	return $this->belongsTo('App\Transaksi','transaksi','id_transaksi');
    }
    public function pembayaran_cicilans()
    {
    	return $this->hasMany('App\PembayaranCicilan','cicilan','id_cicilan');
    }
    public function tanggalMulai()
    {
        return Carbon::parse($this->tanggal_mulai)->format('d M Y');
    }
    public function tanggalAkhir()
    {
        return Carbon::parse($this->tanggal_akhir)->format('d M Y');
    }
    public function adaPembayaran()
    {
        $jumlah = 0;
        foreach($this->pembayaran_cicilans as $pembayaran)
        {
            if($pembayaran->gambar_bukticicilan != null)
            {
                $jumlah++;
            }
        }
        if($jumlah > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function totalCicilan()
    {
        $total = 0;
        foreach($this->pembayaran_cicilans as $cicilan)
        {
            $total += $cicilan->nominal;
        }
        return $total;
    }
    public function totalSesuaiHarga()
    {
        $booking = $this->transaksis->pembayaranbookings->nominal ?? 0;
        $dp = $this->transaksis->pembayarandps->nominal ?? 0;
        $total = $this->transaksis->units->hargaJualCash() - $booking - $dp;
        if($this->totalCicilan() == $total)
        {
            // return ['hasil'=>'sesuai','selisih'=>0];
            return 0;
        }
        elseif($this->totalCicilan() > $total)
        {
            // return ['hasil'=>'kelebihan','selisih'=>($this->totalCicilan() - $total)];
            return $this->totalCicilan() - $total;
        }
        else
        {
            // return ['hasil'=>'kekurangan','selisih'=>($total - $this->totalCicilan())];
            return $total - $this->totalCicilan();
        }
    }
    public function formatUang($nominal)
    {
        return 'Rp'.number_format($nominal,2,'.',',');
    }
    public function batasWaktu()
    {
        $pembayaran_cicilan = $this->pembayaran_cicilans->where('gambar_bukticicilan', null)->first();
        // 6 bulan x 30 hari = 180 hari + 7 hari = 187
        if($pembayaran_cicilan != null)
        {
            return Carbon::parse($pembayaran_cicilan->tenggat_waktu)->diffInDays(Carbon::now()) >= 187;
        }
        else
        {
            return false;
        }
    }
    //
}
