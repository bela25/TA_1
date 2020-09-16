<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    
    protected $primaryKey = 'nip';


    public function chats()
    {
    	return $this->hasMany('App\Chatting');
    }
    public function feedbacks()
    {
    	return $this->hasMany('App\Feedback');
    }
    public function transaksis()
    {
    	return $this->hasMany('App\Transaksi');
    }
    public function spesifikasis()
    {
    	return $this->hasMany('App\Spesifikasi_bangunan');
    }
    public function promosis()
    {
    	return $this->hasMany('App\Promosi');
    }
    public function profils()
    {
    	return $this->hasMany('App\Profil');
    }
    public function pembatalans()
    {
    	return $this->hasMany('App\Pembatalan');
    }
}
