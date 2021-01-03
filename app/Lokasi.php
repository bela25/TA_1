<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $primaryKey = 'idlokasi';

    public function towers()
    {
    	return $this->hasMany('App\Tower','lokasi','idlokasi');
    }
    public function lokasipegawais()
    {
        return $this->hasMany('App\LokasiPegawai','lokasi','idlokasi');
    }
    public function spesifikasi_bangunan()
    {
        return $this->hasOne('App\Spesifikasi_bangunan','lokasi','idlokasi');
    }
    public function beritas()
    {
    	return $this->hasMany('App\Berita','lokasi','idlokasi');
    }
    //
}
