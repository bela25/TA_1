<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaJual extends Model
{
   protected $primaryKey = 'idhargajual';

   public function arahs()
    {
    	return $this->belongsTo('App\Arah_unit');
    }
    public function tipes()
    {
    	return $this->belongsTo('App\Tipe_unit');
    }
    public function towers()
    {
    	return $this->belongsTo('App\Tower');
    }
    //
}
