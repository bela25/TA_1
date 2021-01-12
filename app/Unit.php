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
    	return $this->hasMany('App\Transaksi','unit','id_unit');
    }
    public function hargaJualCash()
    {
        return $this->tipes->hargaJuals->last()->hargajual_cash;
    }
    public function hargaJual()
    {
        return number_format($this->hargaJualCash(),2,',','.');
    }
    
    public function formatUang($nominal)
    {
        return 'Rp'.number_format($nominal,2,',','.');
    }
    public function dp()
    {
        return $this->tipes->hargaJuals->last()->hargajual_cash * 20 / 100;
    }
    public function booking()
    {
        return $this->tipes->hargaJuals->last()->hargajual_cash * 1 / 100;
    }
    public function komisi()
    {
        return $this->hargaJualCash() * 2 / 100;
    }
    public function gambar()
    {
        if($this->tipes->gambars->where('lokasi',$this->towers->lokasis->idlokasi)->first() != null){
            return asset(str_replace('\\', '/', $this->tipes->gambars->where('lokasi',$this->towers->lokasis->idlokasi)->first()->nama_gambar));
        }
        else{
            return asset('web/images/work-2.jpg');
        }
    }
    //
}
