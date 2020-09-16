<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $primaryKey = 'idlokasi';

    public function towers()
    {
    	return $this->hasMany('App\Tower');
    }
    //
}
