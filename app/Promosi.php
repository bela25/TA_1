<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    protected $primaryKey = 'idpromosi';

    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai', 'pegawai', 'nip');
    }
    public function lokasis()
    {
    	return $this->belongsTo('App\Lokasi','lokasi','idlokasi');
    }
    public function sudahBerlaku()
    {
        return $this->tgl_awal <= date('Y-m-d');
    }
    public function sudahBerakhir()
    {
        return $this->tgl_akhir <= date('Y-m-d');
    }
    //
}
