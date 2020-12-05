<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';

    public function nama()
    {
        return $this->customers->nama.' ('.$this->units->nama().')';
    }

    public function bulanLunas()
    {
        return Carbon::parse($this->tgl_pelunasan)->format('F');
    }

    public function tahunLunas()
    {
        return Carbon::parse($this->tgl_pelunasan)->year;
    }

    public function pembatalans()
    {
    	return $this->hasOne('App\Pembatalan','transaksi','id_transaksi');
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
        return $this->hasOne('App\PembayaranBooking','transaksi','id_transaksi');
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
        return 'Rp'.number_format($nominal,2,',','.');
    }
    public function lokasi()
    {
        return $this->units->towers->lokasis;
    }
    //
}
