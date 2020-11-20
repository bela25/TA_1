<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesifikasi_bangunan extends Model
{
    protected $primaryKey = 'idspesifikasi';

    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','pegawai','nip');
    }
    public function lokasis()
    {
    	return $this->belongsTo('App\Lokasi','lokasi','idlokasi');
    }
    //
}
