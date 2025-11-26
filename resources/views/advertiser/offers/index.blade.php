@extends('layouts.app')

@section('content')
    <h1>Мои офферы</h1>

    <a href="{{ route('advertiser.offers.create') }}" class="btn btn-success mb-3">Создать оффер</a>

    <!-- Доска с колонками -->
    <div class="board">
        <!-- <div class="column" data-status="draft" ondrop="drop(event)" ondragover="allowDrop(event)"> -->
        <div class="column" data-status="draft">
            <h3>Черновик</h3>
            @foreach($offers->where('status', 'draft') as $offer)
                <!-- <div class="offer-item" draggable="true" ondragstart="drag(event)" data-id="{{ $offer->id }}"> -->
                <div class="offer-item draft" draggable="true" data-id="{{ $offer->id }}">
                    <div class="offer-header">
                        {{ $offer->name }}
                    </div>
                    <div class="offer-details">
                        <strong>Целевой URL:</strong> {{ $offer->target_url }}<br>
                        <strong>Цена за клик:</strong> {{ $offer->cost_per_click }}<br>
                        <strong>Подписчиков:</strong> {{ $offer->subscribers_count }}
                    </div>
                    <div class="offer-actions">
                        <a href="{{ route('advertiser.offers.edit', $offer) }}" class="btn btn-sm btn-primary">Редактировать</a>
                        <form method="POST" action="{{ route('advertiser.offers.destroy', $offer) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- <div class="column" data-status="active" ondrop="drop(event)" ondragover="allowDrop(event)"> -->
        <div class="column" data-status="active">
            <h3>Активен</h3>
            @foreach($offers->where('status', 'active') as $offer)
                <!-- <div class="offer-item active" draggable="true" ondragstart="drag(event)" data-id="{{ $offer->id }}"> -->
                <div class="offer-item active" draggable="true" data-id="{{ $offer->id }}">
                    <div class="offer-header">
                        {{ $offer->name }}
                    </div>
                    <div class="offer-details">
                        <strong>Целевой URL:</strong> {{ $offer->target_url }}<br>
                        <strong>Цена за клик:</strong> {{ $offer->cost_per_click }}<br>
                        <strong>Подписчиков:</strong> {{ $offer->subscribers_count }}
                    </div>
                    <div class="offer-actions">
                        <a href="{{ route('advertiser.offers.edit', $offer) }}" class="btn btn-sm btn-primary">Редактировать</a>
                        <form method="POST" action="{{ route('advertiser.offers.destroy', $offer) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- <div class="column" data-status="inactive" ondrop="drop(event)" ondragover="allowDrop(event)"> -->
         <div class="column" data-status="inactive">
            <h3>Неактивен</h3>
            @foreach($offers->where('status', 'inactive') as $offer)
                <!-- <div class="offer-item inactive" draggable="true" ondragstart="drag(event)" data-id="{{ $offer->id }}"> -->
                <div class="offer-item inactive" draggable="true" data-id="{{ $offer->id }}">
                    <div class="offer-header">
                        {{ $offer->name }}
                    </div>
                    <div class="offer-details">
                        <strong>Целевой URL:</strong> {{ $offer->target_url }}<br>
                        <strong>Цена за клик:</strong> {{ $offer->cost_per_click }}<br>
                        <strong>Подписчиков:</strong> {{ $offer->subscribers_count }}
                    </div>
                    <div class="offer-actions">
                        <a href="{{ route('advertiser.offers.edit', $offer) }}" class="btn btn-sm btn-primary">Редактировать</a>
                        <form method="POST" action="{{ route('advertiser.offers.destroy', $offer) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

   
@endsection

    <!-- JavaScript для Drag & Drop -->
@push('scripts')
    @vite(['resources/js/advertiser-offers.js'])
@endpush