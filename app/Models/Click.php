<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Click extends Model
{
    protected $fillable = [
        'offer_id',
        'webmaster_id',
        'ip_address',
        'user_agent',
        'redirected_at',
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function webmaster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'webmaster_id');
    }

}