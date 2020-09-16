<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
    	return $this->hasMany('App\Transaksi');
    }

    //
}
