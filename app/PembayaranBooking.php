<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranBooking extends Model
{
    // protected $table = 'pembayaran_bookings';
    protected $primaryKey = 'id_pembayaranbooking';

    public function transaksis()
    {
    	return $this->belongsTo('App\Transaksi','transaksi','id_transaksi');
    }
    public function nominal()
    {
        return 'Rp'.number_format($this->nominal,2,',','.');
    }
    //
}
