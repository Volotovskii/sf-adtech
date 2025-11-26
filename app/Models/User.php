<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // роли TOOD (NULL) подцепть к тому что выбираем при регстации обдумать
        'status', // подтвержадем учёку
        'account_is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Офферы, созданные рекламодателем
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'advertiser_id');
    }

    // TODO переделать
    // Подписки веб-мастера
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'webmaster_id');
    }
    // Подписки веб-мастера
    public function webmaster()
    {
         return $this->hasMany(Subscription::class, 'webmaster_id');
    }

    // перенаправляем на домашнюю страницу TODO дашборд?
      public function redirectTo()
    {
        // Проверяем роль и возвращаем соответствующий маршрут
        if ($this->hasRole('admin')) {
            return route('admin.dashboard');
        } elseif ($this->hasRole('webmaster')) {
            return route('webmaster.dashboard');
        } elseif ($this->hasRole('advertiser')) {
            return route('advertiser.dashboard');
        }

        // роль не распознана
        return '/';
    }
}
