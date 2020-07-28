<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $primaryKey = 'id_feedback';

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
