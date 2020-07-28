<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arah_unit extends Model
{
   protected $primaryKey = 'id_arah';
    
     public function units()
    {
    	return $this->hasMany('App\Unit');
    }
     public function hargajuals()
    {
    	return $this->hasMany('App\HargaJual');
    }
    //
}
