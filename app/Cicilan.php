<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    //
}
