<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KebutuhanPokok extends Model
{
    protected $table = 'kebutuhan_pokok';

    protected $fillable = [
        'user_id',
        'beras',
        'minyak',
        'gas',
        'listrik',
        'air',
        'kesehatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kebutuhanPokok()
{
    return $this->hasOne(KebutuhanPokok::class);
}
}
