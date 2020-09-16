<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
   	protected $primaryKey = 'id_tower';

    public function lokasis()
    {
    	return $this->belongsTo('App\Lokasi','lokasi','idlokasi');
    }
    //
}
