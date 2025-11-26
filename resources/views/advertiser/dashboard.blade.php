@extends('layouts.app')

@section('content')
    <h1>Рекламодатель Dashboard</h1>
    
    @if (session('status'))
        <div class="alert alert-success" role="alert">
    {{ session('status') }}
        </div>
    @endif

    <p>Добро пожаловать, {{ auth()->user()->name }}!</p>

    <a href="{{ route('advertiser.offers.index') }}" class="btn btn-primary">Мои офферы</a>
    <a href="{{ route('advertiser.stats') }}" class="btn btn-info">Статистика</a>
@endsection