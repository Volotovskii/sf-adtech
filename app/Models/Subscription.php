<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{

    protected $fillable = [
        'webmaster_id',
        'offer_id',
        'markup',   // наценка вебмастера
        'is_active', // если отписались
    ];

    // отношение к webmaster
    public function webmaster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'webmaster_id');
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    ////
}
