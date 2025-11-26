<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'webmaster_id',
        'offer_id',
        'ip_address',
        'user_agent',
    ];

    public function webmaster()
    {
        return $this->belongsTo(User::class, 'webmaster_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}