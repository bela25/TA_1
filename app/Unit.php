<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'id_unit';

    public function tipes()
    {
    	return $this->belongsTo('App\Tipe_unit','tipe','id_tipe');
    }
    public function towers()
    {
    	return $this->belongsTo('App\Tower','tower','id_tower');
    }
    public function arahs()
    {
    	return $this->belongsTo('App\Arah_unit','arah','id_arah');
    }
    public function transaksis()
    {
    	return $this->hasMany('App\Transaksi');
    }
    //
}
