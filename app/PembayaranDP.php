<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranDP extends Model
{
    protected $primaryKey = 'id_pembayarandp';

    public function transaksis()
    {
    	return $this->belongsTo('App\Trasaksi');
    }
    //
}
