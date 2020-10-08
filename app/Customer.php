<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $primaryKey = 'idcustomers';

    public function chats()
    {
    	return $this->hasMany('App\Chatting');
    }
    public function feedbacks()
    {
    	return $this->hasMany('App\Feedback');
    }
    public function transaksis()
    {
    	return $this->hasMany('App\Transaksi','customer','idcustomers');
    }
    public function transaksiUnit(Unit $unit)
    {
        return $this->transaksis->where('unit',$unit->id_unit)->last();
    }
    public function unitDimiliki($unit)
    {
        return $this->transaksis->where('units.id_unit',$unit->id_unit)->isNotEmpty();
    }

    //
}
