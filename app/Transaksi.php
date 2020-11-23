<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';

    public function nama()
    {
        return $this->customers->nama.' ('.$this->units->nama().')';
    }

    public function pembatalans()
    {
    	return $this->hasOne('App\Pembatalan');
    }
    public function cicilans()
    {
    	return $this->hasOne('App\Cicilan','transaksi','id_transaksi');
    }
    public function pembayarandps()
    {
    	return $this->hasOne('App\PembayaranDP','transaksi','id_transaksi');
    }
    public function pembayaranbookings()
    {
        return $this->hasOne('App\PembayaranBooking');
    }
    public function units()
    {
    	return $this->belongsTo('App\Unit','unit','id_unit');
    }
    public function customers()
    {
    	return $this->belongsTo('App\Customer','customer','idcustomers');
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','pegawai','nip');
    }
    public function komisipegawai()
    {
        return $this->hasOne('App\KomisiPegawai','transaksi');
    }

    public function formatUang($nominal)
    {
        return number_format($nominal,2,',','.');
    }
    public function lokasi()
    {
        return $this->units->towers->lokasis;
    }
    //
}
