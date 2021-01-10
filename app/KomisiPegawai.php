<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomisiPegawai extends Model
{
	protected $primaryKey = 'idkomisi_pegawai';
    
    public function transaksis()
    {
    	return $this->belongsTo('App\Trasaksi');
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai');
    }
    public function formatBonus()
    {
        return 'Rp'.number_format($this->bonus,2,',','.');
    }
}
