<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $primaryKey = 'idprofil';

     public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai');
    }
    //
}
