<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        // $offers = auth()->user()->offers()->with(['subscriptions' => function ($query) {
        //     $query->where('is_active', true)->with('webmaster');
        // }])->get();

     $offers = auth()->user()->offers()->with(['subscriptions' => function ($query) {
        $query->where('subscriptions.is_active', true) // <-- Указываем имя таблицы
              ->with('webmaster');
    }])->get();

        return view('advertiser.offers.index', compact('offers'));
        
    }


    public function create()
    {
        return view('advertiser.offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_url' => 'required|url',
            'cost_per_click' => 'required|numeric|min:0.01',
            'category' => 'nullable|string|max:255',
        ]);

        $offer = new Offer();
        $offer->name = $request->name;
        $offer->target_url = $request->target_url;
        $offer->cost_per_click = $request->cost_per_click;
        $offer->category = $request->category;
        $offer->advertiser_id = auth()->id();
        $offer->save();

        return redirect()->route('advertiser.offers.index')->with('success', 'Offer created successfully!');
    }

    public function show(Offer $offer)
    {
        $this->authorizeOffer($offer);
        return view('advertiser.offers.show', compact('offer'));
    }

    public function edit(Offer $offer)
    {
        $this->authorizeOffer($offer);
        return view('advertiser.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        //оффер принадлежит рекламодателю
        $this->authorizeOffer($offer);

        $request->validate([
            'name' => 'required|string|max:255',
            'target_url' => 'required|url',
            'cost_per_click' => 'required|numeric|min:0.01',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'status' => 'required|in:draft,active,inactive',
        ]);

        //, 'is_active'
        //Обновляет модель Offer в базе данных
        //only нужные поля
        $offer->update($request->only(['name', 'target_url', 'cost_per_click', 'category', 'status']));

        $data = $request->only(['name', 'target_url', 'cost_per_click', 'category', 'is_active']);
        // Если `is_active` = false, и `status` был `active`, то переводим в `inactive`
        if ($request->has('is_active') && $request->is_active === false) {
            if ($offer->status === 'active') {
                $data['status'] = 'inactive';
            }
            $data['is_active'] = false;
        } elseif ($request->has('is_active') && $request->is_active === true) {
            // Если `is_active` = true, и `status` был `inactive`, то возвращаем в `active`
            if ($offer->status === 'inactive') {
                $data['status'] = 'active';
            }
            $data['is_active'] = true;
        }
        $offer->update($data);
        // Если оффер отключил (advertiser)  деактивируем все подписки
        // if (!$offer->is_active) {
        //     $offer->subscriptions()->update(['is_active' => false]);
        // }
        // не работает?
        // Если оффер переведён в "inactive", отключим все подписки
        if ($offer->status === 'inactive') {
            $offer->subscriptions()->update(['is_active' => false]);
        }


        //dd($request->all());
        return redirect()->route('advertiser.offers.index')->with('success', 'Offer updated successfully!');
    }

    // под активный атрибут хотел в оффере
    // public function updateStatus(Request $request, Offer $offer)
    // {
    //     $request->validate([
    //         'status' => 'required|in:draft,active,inactive'
    //     ]);

    //     $offer->update(['status' => $request->status]);

    //     return response()->json(['message' => 'Статус обновлён']);
    // }

    public function updateStatus(Request $request, Offer $offer)
    {
        //оффер принадлежит рекламодателю
        $this->authorizeOffer($offer);

        $request->validate([
            'status' => 'required|in:draft,active,inactive'
        ]);


        $offer->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully']);
    }


    public function destroy(Offer $offer)
    {
        $this->authorizeOffer($offer);
        $offer->delete();

        return redirect()->route('advertiser.offers.index')->with('success', 'Offer deleted successfully!');
    }

    private function authorizeOffer(Offer $offer)
    {
        if ($offer->advertiser_id !== auth()->id()) {
            abort(403);
        }
    }
}
