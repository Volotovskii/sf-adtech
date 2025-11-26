@extends('layouts.app')

@section('content')
<h1>Статистика (Веб-мастер)</h1>

<div class="filters-container">
    <form method="GET" action="{{ route('webmaster.stats') }}">
        <div class="filter-group">
            <label for="group_by">Группировка:</label>
            <select name="group_by" id="group_by">
                <option value="day" {{ request('group_by') === 'day' ? 'selected' : '' }}>По дням</option>
                <option value="hour" {{ request('group_by') === 'hour' ? 'selected' : '' }}>По часам</option>
                <option value="minute" {{ request('group_by') === 'minute' ? 'selected' : '' }}>По минутам</option>
                <option value="month" {{ request('group_by') === 'month' ? 'selected' : '' }}>По месяцам</option>
                <option value="year" {{ request('group_by') === 'year' ? 'selected' : '' }}>По годам</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="offer_id">Оффер:</label>
            <select name="offer_id" id="offer_id">
                <option value="">Все офферы</option>
                @foreach($allSubscriptions as $subscription)
                <option value="{{ $subscription->offer->id }}" {{ request('offer_id') == $subscription->offer->id ? 'selected' : '' }}>
                    {{ $subscription->offer->trashed() ? '[АРХИВ] ' : '' }}
                    {{ $subscription->is_active ? '' : '[НЕАКТИВЕН] ' }}
                    {{ $subscription->offer->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="status">Статус:</label>
            <select name="status" id="status">
                <option value="">Все</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Активные</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Неактивные</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Архив</option>
            </select>
        </div>

        <button type="submit" class="btn-apply">Применить</button>
    </form>
</div>

<p class="total-earnings">Всего заработано: {{ number_format($totalEarnings, 2) }} руб.</p>

<!-- Контейнер для графиков -->
<div class="row">
    <div class="col-md-6">
        <h4>Количество переходов</h4>
        <canvas id="clicksChart" width="400" height="200"></canvas>
    </div>
    <div class="col-md-6">
        <h4>Доходы (руб.)</h4>
        <canvas id="earningsChart" width="400" height="200"></canvas>
    </div>
</div>
<script>
    window.appData = {
        allClicks: @json($allClicks),
        allEarnings: @json($allEarnings)
    };
</script>
@endsection

@push('scripts')
@vite(['resources/js/webmaster-stats.js'])
@endpush