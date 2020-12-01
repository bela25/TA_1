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
    //
}
