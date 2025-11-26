@extends('layouts.app')

@section('content')
<h1>Мои ссылки</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Оффер</th>
            <th>Целевой URL</th>
            <th>Статус</th>
            <th>Ссылка</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subscriptions as $subscription)
        @php
        $offer = $subscription->offer;
        $isTrashed = $offer && $offer->trashed();
        $isOfferActive = $offer && $offer->is_active;
        $isSubscribed = $subscription->is_active;
        @endphp
        <tr class="
                    @if($isSubscribed && $isOfferActive && !$isTrashed)
                        table-success
                    @elseif(!$isSubscribed || !$isOfferActive)
                        table-warning
                    @elseif($isTrashed)
                        table-secondary
                    @endif
                "
            data-previous-markup="{{ $subscription->markup }}"
            data-webmaster-id="{{ auth()->id() }}">
            <td>
                @if($isTrashed)
                [АРХИВ] {{ $offer->name }}
                @elseif(!$isOfferActive)
                [НЕАКТИВЕН] {{ $offer->name }}
                @else
                {{ $offer->name }}
                @endif
            </td>
            <td>{{ $offer->target_url ?? 'N/A' }}</td>
            <td>
                @if($isSubscribed && $isOfferActive && !$isTrashed)
                <span class="badge bg-success">Активна</span>
                @elseif(!$isSubscribed)
                <span class="badge bg-warning">Отписался</span>
                @elseif(!$isOfferActive)
                <span class="badge bg-danger">Оффер неактивен</span>
                @elseif($isTrashed)
                <span class="badge bg-secondary">Оффер удалён</span>
                @endif
            </td>
            <td>
                @if($isSubscribed && $isOfferActive && !$isTrashed)
                <input type="text" class="form-control" value="{{ url('/go/' . $offer->id . '?webmaster_id=' . auth()->id()) }}" readonly>
                @else
                <input type="text" class="form-control" value="Ссылка недоступна" readonly disabled>
                @endif
            </td>
            <td>
                @if($isSubscribed && $isOfferActive && !$isTrashed)
                <!-- Кнопка отписки -->
                <form method="POST" action="{{ route('webmaster.unsubscribe', $offer->id) }}" class="d-inline unsubscribe-form-links" id="unsubscribe-form-{{ $offer->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Отписаться?')">Отписаться</button>
                </form>
                @elseif(!$isSubscribed)
                <!-- Кнопка "Возобновить" -->
                <form method="POST" action="{{ route('webmaster.subscribe', $offer->id) }}" class="d-inline subscribe-form-links" id="subscribe-form-{{ $offer->id }}">
                    @csrf
                    <input type="number" name="markup" value="{{ $subscription->markup }}" step="0.01" min="0">
                    <button type="submit" class="btn btn-success btn-sm">Возобновить</button>
                </form>
                @else
                <span>Недоступно</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
@vite(['resources/js/webmaster-links.js'])
@endpush