<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
    'name','email','password','nik','alamat','no_kk', 'lat', 'lng', 'is_checked'
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    /**
     * Relasi ke tabel kebutuhan_pokok
     */
    // Ambil kebutuhan pokok terakhir (untuk progress & evaluasi)
    public function kebutuhanPokok()
    {
        return $this->hasOne(KebutuhanPokok::class)->latestOfMany();
    }

    // Ambil semua histori kebutuhan pokok
    public function semuaKebutuhanPokok()
    {
        return $this->hasMany(KebutuhanPokok::class);
    }

    public function kebutuhanPendidikan()
    {
        return $this->hasOne(KebutuhanPendidikan::class)->latestOfMany();
    }

    public function semuaKebutuhanPendidikan()
    {
        return $this->hasMany(KebutuhanPendidikan::class);
    }

    public function penghasilan()
    {
        return $this->hasOne(Penghasilan::class)->latestOfMany();
    }

    public function semuaPenghasilan()
    {
        return $this->hasMany(Penghasilan::class);
    }
}