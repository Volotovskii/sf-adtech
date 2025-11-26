<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Offer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Statistic; // ✅


class WebmasterController extends Controller
{
    public function dashboard()
    {
        $totalClicks = Click::where('webmaster_id', auth()->id())->count();

        return view('webmaster.dashboard', compact('totalClicks'));
    }


    // public function offers()
    // {

    //     // Доступные офферы (не подписан или подписка неактивна)
    //     // Доступные офферы (не подписан или подписка неактивна)
    //     $availableOffers = Offer::where('is_active', true)
    //         ->where(function ($query) {
    //             $query->whereDoesntHave('subscriptions', function ($subQuery) {
    //                 $subQuery->where('webmaster_id', auth()->id());
    //             })
    //                 ->orWhereHas('subscriptions', function ($subQuery) {
    //                     $subQuery->where('webmaster_id', auth()->id())
    //                         ->where('is_active', false); // Неактивные подписки
    //                 });
    //         })
    //         ->get();

    //     // Доступные офферы (не подписан)
    //     // $availableOffers = Offer::where('is_active', true)->whereDoesntHave('subscriptions', function ($query) {
    //     //     $query->where('webmaster_id', auth()->id());
    //     // })->get();


    //     // Подписки (все, включая неактивные)
    //     // $subscribedOffers = auth()->user()->subscriptions()
    //     //     ->with('offer') //
    //     //     ->get();

    //     // Только активные подписки
    //     // Подписки (только активные объекты Subscription)
    //     $subscribedOffers = auth()->user()->subscriptions()
    //         ->where('is_active', true)
    //         ->with('offer') // Загружаем связанный оффер
    //         ->get(); // <-- Используем get(), чтобы получить коллекцию объектов Subscription

    //     //$offers = Offer::where('is_active', true)->get();

    //     // Теперь получаем список ID подписанных офферов из коллекции объектов
    //     $subscribedOfferIds = $subscribedOffers->pluck('offer_id');

    //      return view('webmaster.offers', compact('availableOffers', 'subscribedOffers', 'subscribedOfferIds'));
    //     //return view('webmaster.offers', compact('availableOffers', 'subscribedOffers', 'subscribedOfferIds'));


    //     //$subscribedOfferIds = auth()->user()->subscriptions()->pluck('offer_id');


    //     //return view('webmaster.offers', compact('offers', 'subscribedOfferIds', 'subscribedOffers'));
    // }



    public function offers()
    {
        // Доступные офферы (не подписан или подписка неактивна)
        $availableOffers = Offer::where('is_active', true)
            ->where(function ($query) {
                $query->whereDoesntHave('subscriptions', function ($subQuery) {
                    $subQuery->where('webmaster_id', auth()->id());
                })
                    ->orWhereHas('subscriptions', function ($subQuery) {
                        $subQuery->where('webmaster_id', auth()->id())
                            ->where('is_active', false); // Неактивные подписки
                    });
            })
            ->get();

        // Подписки (только активные , связанные с НЕ удалёнными офферами)
        $subscribedOffers = auth()->user()->subscriptions()
            ->where('is_active', true)
            ->whereHas('offer', function ($query) {
                $query->where('is_active', true);
            })
            ->with('offer')
            ->get();

        $subscribedOfferIds = $subscribedOffers->pluck('offer_id');

        return view('webmaster.offers', compact('availableOffers', 'subscribedOffers', 'subscribedOfferIds'));
    }

    // активация подписки
    // public function subscribe(Request $request, $offerId)
    // {
    //     $offer = Offer::find($offerId);

    //     if (!$offer || !$offer->is_active || $offer->trashed()) {
    //         // return redirect()->back()->with('error', 'Offer not found or inactive.');
    //         return response()->json(['success' => false, 'message' => 'Предложение не найдено или неактивно.'], 404);
    //     }

    //     $subscription = Subscription::where('webmaster_id', auth()->id())
    //         ->where('offer_id', $offerId)
    //         ->first();


    //     if ($subscription) {
    //         // Если подписка была, но неактивна — активируем
    //         if (!$subscription->is_active) {
    //             $subscription->update(['is_active' => true, 'markup' => $request->markup ?? 0]);

    //             // Вариант 2: Предложить обновить наценку (вернуть успех, но с сообщением)
    //             //$subscription->update(['markup' => $request->markup ?? $subscription->markup]); // Обновить наценку, если передана
    //             return response()->json(['success' => true, 'message' => 'Подписка успешно возобновлена!']);
    //             //return redirect()->back()->with('success', 'Subscription reactivated successfully!');
    //         } else {
    //             // Подписка была, но неактивна - активируем и обновляем наценку
    //             return response()->json(['success' => false, 'message' => 'Уже подписан.'], 400);
    //             // return redirect()->back()->with('error', 'Already subscribed.');
    //         }
    //     }

    //     Subscription::create([
    //         'webmaster_id' => auth()->id(),
    //         'offer_id' => $offerId,
    //         'markup' => $request->markup ?? 0,
    //         'is_active' => true,
    //     ]);

    //     //return redirect()->back()->with('success', 'Subscribed successfully!');
    //     return response()->json(['success' => true, 'message' => 'Подписка успешно оформлена!']);
    // }



    // активация подписки
    public function subscribe(Request $request, $offerId)
    {
        $offer = Offer::find($offerId);

        if (!$offer || !$offer->is_active || $offer->trashed()) {

            $errorMessage = 'Предложение не найдено или неактивно.';


            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 404);
            }


            return redirect()->back()->with('error', $errorMessage);
        }

        $subscription = Subscription::where('webmaster_id', auth()->id())
            ->where('offer_id', $offerId)
            ->first();

        $successMessage = '';
        $shouldRedirect = false;

        if ($subscription) {
            if (!$subscription->is_active) {
                $subscription->update(['is_active' => true, 'markup' => $request->markup ?? 0]);
                $successMessage = 'Подписка успешно возобновлена!';


                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => true,
                        'message' => $successMessage,
                        'markup' => $request->markup ?? 0,
                    ]);
                }


                return redirect()->back()->with('success', $successMessage);
            } else {

                $errorMessage = 'Уже подписан.';


                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => $errorMessage
                    ], 400);
                }


                return redirect()->back()->with('error', $errorMessage);
            }
        }


        Subscription::create([
            'webmaster_id' => auth()->id(),
            'offer_id' => $offerId,
            'markup' => $request->markup ?? 0,
            'is_active' => true,
        ]);

        $successMessage = 'Подписка успешно оформлена!';


        if ($request->ajax() || $request->wantsJson()) {

            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'markup' => $request->markup ?? 0,

            ]);
        }


        return redirect()->back()->with('success', $successMessage);
    }





    // не удаляем запись а помечаем просто
    // public function unsubscribe($offerId)
    // {
    //     $subscription = Subscription::where('webmaster_id', auth()->id())
    //         ->where('offer_id', $offerId)
    //         ->first();


    //     if (!$subscription) {
    //         return response()->json(['success' => false, 'message' => 'Не подписан.'], 400);
    //     }

    //     if ($subscription) {
    //         $subscription->update(['is_active' => false]);
    //     }
    //     //$subscription->delete();

    //     //return redirect()->back()->with('success', 'Отписка успешно отменена!');
    //     return response()->json(['success' => true, 'message' => 'Отписка успешно отменена!']);
    // }


    public function unsubscribe(Request $request, $offerId) // Добавлен $request в сигнатуру
    {
        $subscription = Subscription::where('webmaster_id', auth()->id())
            ->where('offer_id', $offerId)
            ->first();

        if (!$subscription) {

            $errorMessage = 'Не подписан.';


            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 400);
            }


            return redirect()->back()->with('error', $errorMessage);
        }


        $subscription->update(['is_active' => false]);


        $successMessage = 'Отписка успешно отменена!';


        if ($request->ajax() || $request->wantsJson()) {

            return response()->json([
                'success' => true,
                'message' => $successMessage,

            ]);
        }


        return redirect()->back()->with('success', $successMessage);
    }




    //обновил линк если офер удалили
    public function links()
    {
        $subscriptions = Subscription::where('webmaster_id', auth()->id())
            ->with(['offer' => function ($query) {
                $query->withTrashed(); // Включаем удалённые офферы
            }])
            ->get();


        // Логируем выдачу ссылок
        foreach ($subscriptions as $subscription) {
            if ($subscription->offer && $subscription->is_active) {
                \App\Models\LinkLog::create([
                    'webmaster_id' => auth()->id(),
                    'offer_id' => $subscription->offer->id,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
            }
        }

        return view('webmaster.links', compact('subscriptions'));
    }




    // TODO наценка сейчас хардкор 80 % вынести в настройки админа? указывать что наценка сайта ?
    public function stats(Request $request)
    {
        $groupBy = $request->input('group_by', 'day');
        $offerId = $request->input('offer_id');
        $status = $request->input('status');

        $query = Subscription::where('webmaster_id', auth()->id())
            ->with(['offer' => function ($query) {
                $query->withTrashed(); // ✅ Включаем удалённые офферы
            }]);


        // Фильтр по статусу
        if ($status === 'active') {
            $query->where('is_active', true); // ✅ Фильтруем запрос
        } elseif ($status === 'inactive') {
            $query->where('is_active', false); // ✅
        }

        $allSubscriptions = $query->get(); // получаем результат

        $allClicks = [];
        $allEarnings = [];

        if ($offerId) {
            $subscription = $allSubscriptions->firstWhere('offer_id', $offerId);

            if ($subscription && $subscription->offer) {
                switch ($groupBy) {
                    case 'hour':
                        $clicks = Click::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) as count')
                            ->groupBy('period')
                            ->orderBy('period')
                            ->get();

                        $earnings = Statistic::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, SUM(revenue) as total_earnings')
                            ->groupBy('period')
                            ->orderBy('period')
                            ->get();
                        break;
                    case 'minute':
                        $clicks = Click::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, COUNT(*) as count')
                            ->groupBy('period')
                            ->orderBy('period')
                            ->get();

                        $earnings = Statistic::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, SUM(revenue) as total_earnings')
                            ->groupBy('period')
                            ->orderBy('period')
                            ->get();
                        break;
                         case 'month':
                        $clicks = Click::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, COUNT(*) as count') // Извлекаем Год-Месяц
                            ->groupBy('period') 
                            ->orderBy('period') 
                            ->get();

                        $earnings = Statistic::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(revenue) as total_earnings') // Извлекаем Год-Месяц, суммируем
                            ->groupBy('period') 
                            ->orderBy('period')
                            ->get();
                        break;
                    case 'year':
                        $clicks = Click::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y") as period, COUNT(*) as count') // Извлекаем Год
                            ->groupBy('period') 
                            ->orderBy('period') 
                            ->get();

                        $earnings = Statistic::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE_FORMAT(created_at, "%Y") as period, SUM(revenue) as total_earnings') // Извлекаем Год, суммируем
                            ->groupBy('period') 
                            ->orderBy('period')
                            ->get();
                        break;
                    case 'day':
                    default:
                        $clicks = Click::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE(created_at) as period, COUNT(*) as count')
                            ->groupBy('period')
                            ->orderBy('period')
                            ->get();

                        $earnings = Statistic::where('webmaster_id', auth()->id())
                            ->where('offer_id', $offerId)
                            ->selectRaw('DATE(created_at) as period, SUM(revenue) as total_earnings')
                            ->groupBy('period')
                            ->orderBy('period')
                            ->get();
                        break;
                }

                $allClicks[$offerId] = [
                    'name' => $subscription->offer->trashed() ? '[АРХИВ] ' . $subscription->offer->name : $subscription->offer->name,
                    'data' => $clicks
                ];

                $allEarnings[$offerId] = [
                    'name' => $subscription->offer->trashed() ? '[АРХИВ] ' . $subscription->offer->name : $subscription->offer->name,
                    'data' => $earnings
                ];
            }
        } else {
            foreach ($allSubscriptions as $subscription) {
                if ($subscription->offer) {
                    switch ($groupBy) {
                        case 'hour':
                            $clicks = Click::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) as count')
                                ->groupBy('period')
                                ->orderBy('period')
                                ->get();

                            $earnings = Statistic::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, SUM(revenue) as total_earnings')
                                ->groupBy('period')
                                ->orderBy('period')
                                ->get();
                            break;
                        case 'minute':
                            $clicks = Click::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, COUNT(*) as count')
                                ->groupBy('period')
                                ->orderBy('period')
                                ->get();

                            $earnings = Statistic::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, SUM(revenue) as total_earnings')
                                ->groupBy('period')
                                ->orderBy('period')
                                ->get();
                            break;
                            case 'month':
                            $clicks = Click::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, COUNT(*) as count') // Извлекаем Год-Месяц
                                ->groupBy('period') 
                                ->orderBy('period') 
                                ->get();

                            $earnings = Statistic::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(revenue) as total_earnings') // Извлекаем Год-Месяц, суммируем
                                ->groupBy('period') 
                                ->orderBy('period') 
                                ->get();
                            break;

                        case 'year':
                            $clicks = Click::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y") as period, COUNT(*) as count') // Извлекаем Год
                                ->groupBy('period') 
                                ->orderBy('period')
                                ->get();

                            $earnings = Statistic::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE_FORMAT(created_at, "%Y") as period, SUM(revenue) as total_earnings') // Извлекаем Год, суммируем
                                ->groupBy('period')
                                ->orderBy('period') 
                                ->get();
                            break;
                        case 'day':
                        default:
                            $clicks = Click::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE(created_at) as period, COUNT(*) as count')
                                ->groupBy('period')
                                ->orderBy('period')
                                ->get();

                            $earnings = Statistic::where('webmaster_id', auth()->id())
                                ->where('offer_id', $subscription->offer_id)
                                ->selectRaw('DATE(created_at) as period, SUM(revenue) as total_earnings')
                                ->groupBy('period')
                                ->orderBy('period')
                                ->get();
                            break;
                    }

                    $allClicks[$subscription->offer_id] = [
                        'name' => $subscription->offer->trashed() ? '[АРХИВ] ' . $subscription->offer->name : $subscription->offer->name,
                        'data' => $clicks
                    ];

                    $allEarnings[$subscription->offer_id] = [
                        'name' => $subscription->offer->trashed() ? '[АРХИВ] ' . $subscription->offer->name : $subscription->offer->name,
                        'data' => $earnings
                    ];
                }
            }
        }

        $totalEarnings = collect($allEarnings)->flatMap(function ($item) {
            return $item['data']->pluck('total_earnings');
        })->sum();

        return view('webmaster.stats', compact('allClicks', 'allEarnings', 'groupBy', 'allSubscriptions', 'offerId', 'totalEarnings'));
    }

    //TODO для default? 
    public function offers_sql($responce, $data)
    {
        $clicks = Click::where('webmaster_id', auth()->id())
            ->where('offer_id', $responce)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d' . $data . '") as period, COUNT(*) as count')
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        $earnings = Statistic::where('webmaster_id', auth()->id())
            ->where('offer_id', $responce)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d' . $data . '") as period, SUM(revenue) as total_earnings')
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        //ассоциативный
        return [
            'clicks' => $clicks,
            'earnings' => $earnings,
        ];
    }

    //TODO перепроверить наценку
    public function updateMarkup(Request $request, $offerId)
    {
        $subscription = Subscription::where('webmaster_id', auth()->id())
            ->where('offer_id', $offerId)
            ->first();

        if (!$subscription) {
            // return redirect()->back()->with('error', 'Subscription not found.');
            //верну json для скриптов
            return response()->json(['success' => false, 'message' => 'Подписка не найдена.'], 404);
        }

        $request->validate([
            'markup' => 'required|numeric|min:0',
        ]);

        $subscription->update([
            'markup' => $request->markup,
        ]);

        //return redirect()->back()->with('success', 'Успешно обновлено!');
        return response()->json(['success' => true, 'message' => 'Успешно обновлено!', 'markup' => $request->markup]);
    }
}
