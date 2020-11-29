<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe_unit extends Model
{
    protected $primaryKey = 'id_tipe';

    public function units()
    {
    	return $this->hasMany('App\Unit','tipe','id_tipe');
    }

    public function gambars()
    {
    	return $this->hasMany('App\GambarProduk','tipe','id_tipe');
    }

    public function hargajuals()
    {
    	return $this->hasMany('App\HargaJual','tipe','id_tipe');
    }
    //
}
