@extends('layouts.app')

@section('content')
    <h1>Создать оффер</h1>

    <form method="POST" action="{{ route('advertiser.offers.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="target_url" class="form-label">Целевой URL</label>
            <input type="url" name="target_url" id="target_url" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cost_per_click" class="form-label">Цена за клик</label>
            <input type="number" name="cost_per_click" id="cost_per_click" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <input type="text" name="category" id="category" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Создать</button>
    </form>
@endsection