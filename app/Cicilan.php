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
    //
}
