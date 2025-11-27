@extends('layouts.app')

@section('content')
<h1>Доступные офферы</h1>

<!-- Доска с колонками -->
<div class="board">
    <!-- Активные офферы (доступные для подписки) -->
    <div class="column" data-column="active">
        <h3>Активные офферы</h3>

        @foreach($availableOffers as $offer)
            <div class="offer-item offer-active" draggable="true" data-id="{{ $offer->id }}">
                <div class="offer-header">
                    @if($offer->trashed())
                        [АРХИВ] {{ $offer->name }}
                    @else
                        {{ $offer->name }}
                    @endif
                </div>
                <div class="offer-details">
                    <strong>Целевой URL:</strong> {{ $offer->target_url }}<br>
                    <strong>Цена за клик:</strong> <span id="cost-per-click-{{ $offer->id }}">{{ $offer->cost_per_click }}</span>
                    <!-- Контейнер для наценки, изначально пустой для доступных офферов -->
                    <span id="markup-display-{{ $offer->id }}" class="markup-display" style="display: none;"><br><strong>Наценка:</strong> <span class="markup-value"></span></span>
                </div>
                <div class="offer-actions">
                    <form method="POST" action="{{ route('webmaster.subscribe', $offer->id) }}" class="d-inline subscribe-form">
                        @csrf
                        <input type="number" name="markup" placeholder="Наценка" step="0.01" min="0" required class="markup-input" draggable="false">
                        <button type="submit" class="btn btn-primary btn-sm">Подписаться</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Подписки -->
    <div class="column" data-column="subscribed">
        <h3>Мои подписки</h3>
        @foreach($subscribedOffers as $subscription)
            @php
                // $subscription->offer гарантированно существует и не удалён благодаря фильтрации в контроллере
                $relatedOffer = $subscription->offer;
            @endphp
            <div class="offer-item offer-subscribed" draggable="true" data-id="{{ $relatedOffer->id }}"> <!-- Используем ID оффера -->
                <div class="offer-header">
                    {{ $relatedOffer->name }}
                </div>
                <div class="offer-details">
                    <strong>Целевой URL:</strong> {{ $relatedOffer->target_url }}<br>
                    <strong>Цена за клик:</strong> <span id="cost-per-click-{{ $relatedOffer->id }}">{{ $relatedOffer->cost_per_click }}</span>
                    <!-- Контейнер для наценки -->
                    <span id="markup-display-{{ $relatedOffer->id }}" class="markup-display"><br><strong>Наценка:</strong> <span class="markup-value">{{ $subscription->markup }}</span></span>
                </div>
                <div class="offer-actions">
                    <form method="POST" action="{{ route('webmaster.unsubscribe', $relatedOffer->id) }}" class="d-inline unsubscribe-form" data-offer-id="{{ $relatedOffer->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Отписаться?')">Отписаться</button>
                    </form>
                    <form method="POST" action="{{ route('webmaster.update-markup', $relatedOffer->id) }}" class="d-inline update-markup-form" data-offer-id="{{ $relatedOffer->id }}">
                        @csrf
                        @method('PUT')
                        <input type="number" name="markup" value="{{ $subscription->markup }}" step="0.01" min="0" draggable="false" class="markup-input">
                        <button type="submit" class="btn btn-warning btn-sm">Изменить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
    @vite(['resources/js/webmaster-offers.js'])
@endpush