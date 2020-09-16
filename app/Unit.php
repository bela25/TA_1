<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'id_unit';

    public function tipes()
    {
    	return $this->belongsTo('App\Tipe_unit');
    }
    public function towers()
    {
    	return $this->belongsTo('App\Tower');
    }
    public function arahs()
    {
    	return $this->belongsTo('App\Arah_unit');
    }
    public function transaksis()
    {
    	return $this->hasMany('App\Transaksi');
    }
    //
}
