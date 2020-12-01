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
    public function adaTransaksi()
    {
        $jumlah = 0;
        foreach($this->lokasis->towers as $tower)
        {
            foreach($tower->units as $unit)
            {
                if($unit->transaksis->count() > 0)
                {
                    $jumlah++;
                }
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
