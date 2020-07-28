<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembatalan extends Model
{
   protected $primaryKey = 'id_pembatalan';


     public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai');
    }
     public function transaksis()
    {
    	return $this->belongsTo('App\Trasaksi');
    }
    //
}
