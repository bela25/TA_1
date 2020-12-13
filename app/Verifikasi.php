<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    public function tanggal()
    {
        return Carbon::parse($this->tanggal)->format('d M Y');
    }
}
