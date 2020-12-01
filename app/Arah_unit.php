<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arah_unit extends Model
{
    protected $primaryKey = 'id_arah';
    
    public function units()
    {
    	return $this->hasMany('App\Unit','arah','id_arah');
    }
    public function hargajuals()
    {
    	return $this->hasMany('App\HargaJual');
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
