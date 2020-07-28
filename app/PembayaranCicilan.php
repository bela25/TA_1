<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranCicilan extends Model
{
   protected $primaryKey = 'id_pembayarancicilan';

    public function cicilans()
    {
    	return $this->belongsTo('App\Cicilan');
    }
    //
}
