@extends('layouts.app')

@section('content')
<h1>Веб-мастер Dashboard</h1>

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<p>Добро пожаловать, {{ auth()->user()->name }}!</p>

<a href="{{ route('webmaster.offers') }}" class="btn btn-primary">Доступные офферы</a>
<a href="{{ route('webmaster.links') }}" class="btn btn-success">Мои ссылки</a>
<a href="{{ route('webmaster.stats') }}" class="btn btn-info">Статистика</a>

@endsection