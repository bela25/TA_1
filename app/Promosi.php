<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    protected $primaryKey = 'idpromosi';

    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai');
    }
    //
}
