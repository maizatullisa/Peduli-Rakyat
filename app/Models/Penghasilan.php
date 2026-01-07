<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penghasilan extends Model
{
    // Nama tabel di database
    protected $table = 'penghasilan';

    // Kolom yang boleh diisi secara massal (tanpa user_id)
    protected $fillable = [
        'gaji',
        'tanggal',
    ];

    // Relasi: penghasilan dimiliki oleh satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function penghasilan()
{
    return $this->hasOne(Penghasilan::class);
}


}
