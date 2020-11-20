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
    //
}
