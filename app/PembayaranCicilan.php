<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranCicilan extends Model
{
    protected $primaryKey = 'id_pembayarancicilan';

    public function cicilans()
    {
    	return $this->belongsTo('App\Cicilan','cicilan','id_cicilan');
    }
    public function formatUang($nominal)
    {
        return number_format($nominal,2,',','.');
    }
    //
}
