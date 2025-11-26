<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // бд просто для суммы?

class AdvertiserController extends Controller
{
    public function dashboard()
    {
        $offers = auth()->user()->offers;
        $totalClicks = Click::whereIn('offer_id', $offers->pluck('id'))->count();

        return view('advertiser.dashboard', compact('offers', 'totalClicks'));
    }

    // public function stats(Request $request)
    // {
    //     $groupBy = $request->input('group_by', 'day');
    //     $offers = auth()->user()->offers;

    //     $allStats = []; // клики
    //     $allCosts = []; // расходы

    //     foreach ($offers as $offer) {
    //         // для выбора даты
    //         switch ($groupBy) {
    //             case 'hour':
    //                 $clicks = Click::where('offer_id', $offer->id)
    //                     ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) as count')
    //                     ->groupBy('period')
    //                     ->orderBy('period')
    //                     ->get();
    //                 // Расходы: кол-во кликов * стоимость за клик
    //                 $costs = Click::where('offer_id', $offer->id)
    //                     ->selectRaw('DATE(created_at) as period, CAST(COUNT(*) * ' . $offer->cost_per_click . ' AS DECIMAL(10,2)) as total_cost')
    //                     ->groupBy('period')
    //                     ->orderBy('period')
    //                     ->get();
    //                 break;
    //             case 'minute':
    //                 $clicks = Click::where('offer_id', $offer->id)
    //                     ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, COUNT(*) as count')
    //                     ->groupBy('period')
    //                     ->orderBy('period')
    //                     ->get();
    //                 $costs = Click::where('offer_id', $offer->id)
    //                     ->selectRaw('DATE(created_at) as period, CAST(COUNT(*) * ' . $offer->cost_per_click . ' AS DECIMAL(10,2)) as total_cost')
    //                     ->groupBy('period')
    //                     ->orderBy('period')
    //                     ->get();
    //                 break;
    //             case 'day':
    //             default:
    //                 $clicks = Click::where('offer_id', $offer->id)
    //                     ->selectRaw('DATE(created_at) as period, COUNT(*) as count')
    //                     ->groupBy('period')
    //                     ->orderBy('period')
    //                     ->get();
    //                 $costs = Click::where('offer_id', $offer->id)
    //                     ->selectRaw('DATE(created_at) as period, CAST(COUNT(*) * ' . $offer->cost_per_click . ' AS DECIMAL(10,2)) as total_cost')
    //                     ->groupBy('period')
    //                     ->orderBy('period')
    //                     ->get();
    //                 break;
    //         }

    //         $allStats[$offer->id] = [
    //             'name' => $offer->name,
    //             'clicks' => $clicks,
    //         ];

    //         $allCosts[$offer->id] = [
    //             'name' => $offer->name,
    //             'costs' => $costs,
    //         ];
    //     }
    //     //dd($allStats, $allCosts);
    //     return view('advertiser.stats', compact('allStats', 'allCosts', 'groupBy'));
    // }

    public function stats(Request $request)
    {
        $groupBy = $request->input('group_by', 'day');
        // Получаем *все* офферы текущего рекламодателя, включая trashed
        $offers = auth()->user()->offers()->withTrashed()->get();

        $allStats = []; // клики
        $allCosts = []; // расходы
        $offerDetails = []; // Дополнительная информация об офферах для шаблона

        $totalCosts = 0; // общие расходы

        foreach ($offers as $offer) {
            $isTrashed = $offer->trashed();
            $isOfferActive = $offer->is_active;

            // Формируем имя с пометкой
            $displayName = $offer->name;
            if ($isTrashed) {
                $displayName = "[АРХИВ] " . $displayName;
            } elseif (!$isOfferActive) {
                $displayName = "[НЕАКТИВЕН] " . $displayName;
            }

            // Сохраняем детали оффера
            $offerDetails[$offer->id] = [
                'name' => $displayName,
                'original_name' => $offer->name,
                'is_active' => $isOfferActive,
                'is_trashed' => $isTrashed,
            ];

            // для выбора даты
            switch ($groupBy) {
                case 'hour':
                    $query = Click::where('offer_id', $offer->id);
                    if ($isTrashed) {
                        // Если оффер trashed, можем ограничить статистику до даты удаления
                        // $query->where('created_at', '<=', $offer->deleted_at);
                    }
                    $clicks = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) as count')
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    $costs = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) * ? as total_cost', [$offer->cost_per_click])
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    break;
                case 'minute':
                    $query = Click::where('offer_id', $offer->id);
                    if ($isTrashed) {
                        // $query->where('created_at', '<=', $offer->deleted_at);
                    }
                    $clicks = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, COUNT(*) as count')
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    $costs = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, COUNT(*) * ? as total_cost', [$offer->cost_per_click])
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    break;
                case 'month':
                    $query = Click::where('offer_id', $offer->id);
                    if ($isTrashed) {
                        // $query->where('created_at', '<=', $offer->deleted_at);
                    }
                    $clicks = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, COUNT(*) as count') // Извлекаем Год-Месяц
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    $costs = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, COUNT(*) * ? as total_cost', [$offer->cost_per_click]) // Извлекаем Год-Месяц, умножаем на цену
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    break;
                case 'year': // --- НОВОЕ: Случай для года ---
                    $query = Click::where('offer_id', $offer->id);
                    if ($isTrashed) {
                        // $query->where('created_at', '<=', $offer->deleted_at);
                    }
                    $clicks = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y") as period, COUNT(*) as count') // Извлекаем Год
                        ->groupBy('period') // Группируем по Году
                        ->orderBy('period') // Сортируем по Году
                        ->get();
                    $costs = $query
                        ->selectRaw('DATE_FORMAT(created_at, "%Y") as period, COUNT(*) * ? as total_cost', [$offer->cost_per_click]) // Извлекаем Год, умножаем на цену
                        ->groupBy('period') // Группируем по Году
                        ->orderBy('period') // Сортируем по Году
                        ->get();
                    break;
                case 'day':
                default:
                    $query = Click::where('offer_id', $offer->id);
                    if ($isTrashed) {
                        // $query->where('created_at', '<=', $offer->deleted_at);
                    }
                    $clicks = $query
                        ->selectRaw('DATE(created_at) as period, COUNT(*) as count')
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    $costs = $query
                        ->selectRaw('DATE(created_at) as period, COUNT(*) * ? as total_cost', [$offer->cost_per_click])
                        ->groupBy('period')
                        ->orderBy('period')
                        ->get();
                    break;
            }

            $allStats[$offer->id] = [
                'name' => $displayName, // Используем имя с пометкой
                'data' => $clicks,
            ];

            $allCosts[$offer->id] = [
                'name' => $displayName, // Используем имя с пометкой
                'data' => $costs,
            ];


            $queryForTotal = Click::where('offer_id', $offer->id);
            if ($isTrashed) {
            }

            $totalCostForOffer = $queryForTotal->sum(DB::raw("1 * {$offer->cost_per_click}")); // Количество кликов * цена за клик
            $totalCosts += $totalCostForOffer;
        }


        //dd($allStats, $allCosts, $offerDetails, $totalCosts); // Убрана строка, которая была вне цикла и использовала $offer, $isTrashed не по контексту
        // Передаём $offerDetails в шаблон для формирования списка фильтра
        return view('advertiser.stats', compact('allStats', 'allCosts', 'groupBy', 'offerDetails', 'totalCosts'));
    }


    public function offers()
    {
        $offers = auth()->user()->offers()->with(['subscriptions' => function ($query) {
            $query->where('is_active', true)->with('webmaster');
        }])->get();

        $subscribedOfferIds = auth()->user()->subscriptions()->pluck('offer_id');

        $subscribedOffers = auth()->user()->subscriptions()->with('offer')->get();



        return view('advertiser.offers.index', compact('offers', 'subscribedOfferIds', 'subscribedOffers'));
    }
}
