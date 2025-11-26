<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    protected $fillable = [
        'offer_id',
        'webmaster_id',
        'date',
        'clicks_count',
        'revenue',
        'system_revenue',
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