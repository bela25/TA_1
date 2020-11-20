<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiPegawai extends Model
{
    public function lokasis()
    {
    	return $this->belongsTo('App\Lokasi','lokasi','idlokasi');
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','pegawai','nip');
    }
}
