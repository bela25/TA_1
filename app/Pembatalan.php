<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pembatalan extends Model
{
    protected $primaryKey = 'id_pembatalan';

    public function tanggalPengembalian()
    {
        return Carbon::parse($this->tgl_pengembalian)->format('d F Y');   
    }
    public function bulanLunas()
    {
        return Carbon::parse($this->tanggal_batal)->format('F');
    }
    public function tahunLunas()
    {
        return Carbon::parse($this->tanggal_batal)->year;
    }
    public function pegawais()
    {
    	return $this->belongsTo('App\Pegawai','admin','nip');
    }
    public function transaksis()
    {
    	return $this->belongsTo('App\Transaksi','transaksi','id_transaksi');
    }
    public function nominal()
    {
        return $this->transaksis->units->hargaJualCash() * 80 / 100;
    }
    public function showNominal()
    {
        return 'Rp'.number_format($this->nominal(),2,',','.');
    }
    //
}
