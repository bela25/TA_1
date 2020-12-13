<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PembayaranDP extends Model
{
    protected $table = 'pembayaran_dps';
    protected $primaryKey = 'id_pembayarandp';

    public function transaksis()
    {
    	return $this->belongsTo('App\Transaksi','transaksi','id_transaksi');
    }
    public function nominal()
    {
        return 'Rp'.number_format($this->nominal,2,',','.');
    }
    public function tanggalBayar()
    {
        return Carbon::parse($this->tanggal_bayar)->format('d M Y');
    }
    //
}
