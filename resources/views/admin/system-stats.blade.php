@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Статистика системы</h1>

        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Доход системы</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text display-6">{{ number_format($totalSystemRevenue, 2, '.', ' ') }} руб.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Всего кликов</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text display-6">{{ number_format($totalClicks, 0, '.', ' ') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Успешных редиректов</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text display-6">{{ number_format($totalRedirects, 0, '.', ' ') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Отказов</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text display-6">{{ number_format($failedRedirects, 0, '.', ' ') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Детали</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Выданные ссылки:</strong> {{ number_format($totalLinksGiven, 0, '.', ' ') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection