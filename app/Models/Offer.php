<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes; // "мягкое удаление" для статистики 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'target_url',
        'cost_per_click',
        'category',
        'status',
        'is_active',
        'advertiser_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // При сохранении модели, синхронизируем `is_active` с `status`
    // TODO или просто смотреть по статусу?
    protected static function booted()
    {
        static::saving(function ($offer) {
            switch ($offer->status) {
                case 'draft':
                case 'inactive':
                    $offer->is_active = false;
                     $offer->subscriptions()->update(['is_active' => false]);
                    break;
                case 'active':
                    $offer->is_active = true;
                     $offer->subscriptions()->update(['is_active' => true]);
                    break;
            }
        });
    }

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }

    // Подписки на оффер
    // public function subscriptions(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'subscriptions', 'offer_id', 'webmaster_id')
    //         ->where('role', 'webmaster');
    // }
    public function subscriptions(): BelongsToMany
    {
        //return $this->hasMany(Subscription::class, 'offer_id');
        return $this->belongsToMany(User::class, 'subscriptions', 'offer_id', 'webmaster_id')
            ->where('role', 'webmaster');
    }

    // Кол-во подписчиков
    // учитывать по активным 
    public function getSubscribersCountAttribute()
    {
       // return $this->subscriptions()->where('is_active', true)->count();
       return $this->subscriptions()->where('subscriptions.is_active', true)->count();
    }
}
