<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
	protected $primaryKey = 'idverifikasi';

    public function customers()
    {
    	return $this->belongsTo('App\Customer','customer','idcustomers');
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','pegawai','nip');
    }
}
