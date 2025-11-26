@extends('layouts.app')

@section('content')
<h1>Редактировать оффер</h1>

<form method="POST" action="{{ route('advertiser.offers.update', $offer) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $offer->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="target_url" class="form-label">Целевой URL</label>
        <input type="url" name="target_url" id="target_url" class="form-control" value="{{ old('target_url', $offer->target_url) }}" required>
    </div>

    <div class="mb-3">
        <label for="cost_per_click" class="form-label">Цена за клик</label>
        <input type="number" name="cost_per_click" id="cost_per_click" class="form-control" step="0.01" value="{{ old('cost_per_click', $offer->cost_per_click) }}" required>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Категория</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $offer->category) }}">
    </div>

    <!-- Без 0 не отпрпаляет в форме хм  -->
    <div class="mb-3 form-check">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ $offer->is_active ? 'checked' : '' }}>
        <label for="is_active" class="form-check-label">Активен</label>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Статус</label>
        <select name="status" id="status" class="form-control" required>
            <option value="draft" {{ $offer->status === 'draft' ? 'selected' : '' }}>Черновик</option>
            <option value="active" {{ $offer->status === 'active' ? 'selected' : '' }}>Активен</option>
            <option value="inactive" {{ $offer->status === 'inactive' ? 'selected' : '' }}>Неактивен</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection