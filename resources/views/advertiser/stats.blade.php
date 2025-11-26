@extends('layouts.app')

@section('content')
<h1>Статистика (Advertiser)</h1>


@if(isset($totalCosts))
<p class="total-costs">Всего потрачено: {{ number_format($totalCosts, 2, '.', ' ') }} руб.</p>
@endif


<form method="GET" action="{{ route('advertiser.stats') }}" id="statsFilterForm">
    <div class="form-group mb-3">
        <label for="group_by">Группировать по:</label>
        <select name="group_by" id="group_by" class="form-control">
            <option value="day" {{ request('group_by') === 'day' ? 'selected' : '' }}>По дням</option>
            <option value="hour" {{ request('group_by') === 'hour' ? 'selected' : '' }}>По часам</option>
            <option value="minute" {{ request('group_by') === 'minute' ? 'selected' : '' }}>По минутам</option>
            <option value="month" {{ request('group_by') === 'month' ? 'selected' : '' }}>По месяцам</option>
            <option value="year" {{ request('group_by') === 'year' ? 'selected' : '' }}>По годам</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="offerFilter">Выберите оффер:</label>
        <select name="offer_id" id="offerFilter" class="form-control"> 
            <option value="">Все офферы</option>
            @foreach($offerDetails as $id => $details)
            <option value="{{ $id }}" {{ request('offer_id') == $id ? 'selected' : '' }}>{{ $details['name'] }}</option> <!-- ДОБАВЛЕНО selected -->
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Применить</button>
</form>

<!-- Контейнер для графиков -->
<div class="row">
    <div class="col-md-12">
        <h4>Количество переходов</h4>
        <canvas id="clicksChart" width="400" height="100"></canvas>
    </div>
    <div class="col-md-12 mt-4">
        <h4>Расходы (руб.)</h4>
        <canvas id="costsChart" width="400" height="100"></canvas>
    </div>
</div>

<!-- TODO глабально fetch через маршрут -->
<script>
    window.appData = {
        allStats: @json($allStats),
        allCosts: @json($allCosts)
    };
</script>
@endsection

@push('scripts')
    @vite(['resources/js/advertiser-stats.js'])
@endpush