<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Offer;
use App\Models\Subscription;
use App\Models\Statistic;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($token, Request $request)
    {
        $offerId = $token;
        $webmasterId = $request->query('webmaster_id');


        if (!$webmasterId) {
            // ✅ Логируем отказ: webmaster_id не передан
            \App\Models\RedirectFailure::create([
                'webmaster_id' => null,
                'offer_id' => $offerId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'reason' => 'webmaster_id not provided',
            ]);
            abort(400, 'Webmaster ID not provided.');
        }


        $offer = Offer::find($offerId);


        // проверяем и удалённые и  активный?
        if (!$offer || !$offer->is_active || $offer->trashed()) {
            \App\Models\RedirectFailure::create([
                'webmaster_id' => $webmasterId,
                'offer_id' => $offerId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'reason' => 'offer not active',
            ]);
            abort(404);
        }

        $subscription = Subscription::where('webmaster_id', $webmasterId)
            ->where('offer_id', $offer->id)
            ->first();


        // проверяем и удалённые 
        // Логируем отказ: веб-мастер не подписан или подписка неактивна
        if (!$subscription || !$subscription->is_active) {
            \App\Models\RedirectFailure::create([
                'webmaster_id' => $webmasterId,
                'offer_id' => $offerId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'reason' => !$subscription ? 'not subscribed' : 'subscription inactive',
            ]);
            abort(404);
        }

        // Логируем клик
        $click = Click::create([
            'offer_id' => $offer->id,
            'webmaster_id' => $webmasterId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'redirected_at' => now(),
        ]);


        // Распределение прибыли: 80% веб-мастеру, 20% системе
        // TODO вынести в настройки админа?
        $commissionRate = 0.2;
        $webmasterRate = 1 - $commissionRate;

        $stat = Statistic::firstOrCreate([
            'offer_id' => $offer->id,
            'webmaster_id' => $webmasterId,
            'date' => now()->toDateString(),
        ]);

        $stat->increment('clicks_count');
        $stat->increment('revenue', $offer->cost_per_click * $webmasterRate);
        $stat->increment('system_revenue', $offer->cost_per_click * $commissionRate);
        $stat->save();

        return redirect($offer->target_url);
    }
}
