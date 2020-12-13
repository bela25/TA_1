<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PembayaranCicilan extends Model
{
    protected $primaryKey = 'id_pembayarancicilan';

    public function cicilans()
    {
    	return $this->belongsTo('App\Cicilan','cicilan','id_cicilan');
    }
    public function bulanLunas()
    {
        return Carbon::parse($this->tanggal_bayar)->format('F');
    }
    public function tahunLunas()
    {
        return Carbon::parse($this->tanggal_bayar)->year;
    }
    public function tanggalBayar()
    {
        return Carbon::parse($this->tanggal_bayar)->format('d M Y');
    }
    public function tenggatWaktu()
    {
        return Carbon::parse($this->tenggat_waktu)->format('d M Y');
    }
    public function nominal()
    {
        return 'Rp'.number_format($this->nominal,2,',','.');
    }
    public function formatUang($nominal)
    {
        return number_format($nominal,2,',','.');
    }
    public function jatuhTempo()
    {
        return $this->tenggat_waktu < date('Y-m-d') && $this->tanggal_bayar == null;
    }
    //
}
