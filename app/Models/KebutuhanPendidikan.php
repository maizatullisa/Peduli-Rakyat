<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KebutuhanPendidikan extends Model
{
    protected $table = 'kebutuhan_pendidikan';

    protected $fillable = [
        'user_id',
        'jumlah_anak',
        'spp_per_anak',
        'transport',
        'buku',
        'pendapatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kebutuhanPendidikan()
{
    return $this->hasOne(KebutuhanPendidikan::class);
}
}
