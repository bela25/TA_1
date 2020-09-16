<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    protected $primaryKey = 'id_cicilan';
   
    public function transaksis()
    {
    	return $this->belongsTo('App\Transaksi');
    }
    //
}
