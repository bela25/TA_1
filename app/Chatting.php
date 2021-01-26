<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    protected $primaryKey = 'id_chat';

    public function customers()
    {
    	return $this->belongsTo('App\Customer','customer','idcustomers');
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','pegawai','nip');
    }
    public function units()
    {
    	return $this->belongsTo('App\Unit','unit','id_unit');
    }
    public function tanggal()
    {
        return Carbon::parse($this->tgl_pesan)->format('H:i, d M Y');
    }
    //
}
