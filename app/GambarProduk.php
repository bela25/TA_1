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
    //
}
