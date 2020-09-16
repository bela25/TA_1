<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';

    public function pembatalans()
    {
    	return $this->hasOne('App\Pembatalan');
    }
    public function cicilans()
    {
    	return $this->hasOne('App\Cicilan');
    }
    public function pembayarandps()
    {
    	return $this->hasOne('App\PembayaranDP');
    }
    public function units()
    {
    	return $this->belongsTo('App\Unit');
    }
    public function customers()
    {
    	return $this->belongsTo('App\Customer');
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai');
    }
    //
}
