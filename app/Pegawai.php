<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use Notifiable;

    protected $guard ='pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
        parent::setAttribute($key, $value);
        }
    }

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
