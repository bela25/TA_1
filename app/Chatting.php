<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    protected $primaryKey = 'id_chat';

    public function customers()
    {
    	return $this->belongsTo('App\Customer');
    }
     public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai');
    }
    //
}
