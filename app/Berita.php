<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Berita extends Model
{
    public function lokasis()
    {
    	return $this->belongsTo('App\Lokasi','lokasi','idlokasi');
    }
    public function tanggalBerita()
    {
        return Carbon::parse($this->tanggal)->format('d M Y');
    }
}
