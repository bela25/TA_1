<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
 	protected $primaryKey = 'id_gambarproduk';

 	public function tipes()
    {
    	return $this->belongsTo('App\Tipe_unit','tipe','id_tipe');
    }
    public function adaTransaksi()
    {
        $jumlah = 0;
        foreach($this->tipes->units as $unit)
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
