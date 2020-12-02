<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaJual extends Model
{
   protected $primaryKey = 'idhargajual';

    public function arahs()
    {
    	return $this->belongsTo('App\Arah_unit','arah','id_arah');
    }
    public function tipes()
    {
    	return $this->belongsTo('App\Tipe_unit','tipe','id_tipe');
    }
    public function towers()
    {
    	return $this->belongsTo('App\Tower','tower','id_tower');
    }
    public function formatUang($nominal)
    {
        return 'Rp'.number_format($nominal,2,',','.');
    }
    public function adaTransaksi()
    {
        $jumlah = 0;
        foreach($this->tipes->units as $unit)
        {
            if($this->hargajual_cash == $unit->hargaJualCash() && $unit->transaksis->count() > 0)
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
