<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'id_unit';

    public function nama()
    {
        return $this->tipes->nama.' No.'.$this->no_unit;
    }

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
    public function hargaJualCash()
    {
        return $this->tipes->hargaJuals->last()->hargajual_cash;
    }
    public function hargaJual()
    {
        return number_format($this->hargaJualCash(),2,',','.');
    }
    public function dp()
    {
        return $this->tipes->hargaJuals->last()->hargajual_cash * 20 / 100;
    }
    public function showDp()
    {
        return number_format($this->dp(),2,',','.');
    }
    //
}
