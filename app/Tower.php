<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
   	protected $primaryKey = 'id_tower';

    public function lokasis()
    {
    	return $this->belongsTo('App\Lokasi','lokasi','idlokasi');
    }
    public function units()
    {
    	return $this->hasMany('App\Unit','tower','id_tower');
    }
    public function adaTransaksi()
    {
        $jumlah = 0;
        foreach($this->units as $unit)
        {
            if($unit->transaksis->count() > 0)
            {
                $jumlah++;
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
