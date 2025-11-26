@extends('layouts.app')

@section('content')
    <h1>Статистика (Admin)</h1>

    <form method="GET" action="{{ route('admin.stats') }}">
        <select name="group_by">
            <option value="day" {{ request('group_by') === 'day' ? 'selected' : '' }}>По дням</option>
            <option value="hour" {{ request('group_by') === 'hour' ? 'selected' : '' }}>По часам</option>
            <option value="minute" {{ request('group_by') === 'minute' ? 'selected' : '' }}>По минутам</option>
        </select>
        <button type="submit">Применить</button>
    </form>

    <canvas id="adminChart" width="400" height="200"
            data-data="{{ json_encode($stats->pluck('count')) }}"
            data-labels="{{ json_encode($stats->pluck('period')) }}"></canvas>

<!-- Сначала определяем данные в глобальном объекте -->
<!-- <script>
    window.appData = {
        allStats: @json($allStats),
        allCosts: @json($allCosts)
    };
</script> -->
@endsection

@push('scripts')
    @vite(['resources/js/admin-stats.js'])
@endpush