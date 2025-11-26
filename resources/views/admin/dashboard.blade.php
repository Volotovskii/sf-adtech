@extends('layouts.app')

@section('content')
    <h1>Администратор Dashboard</h1>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
    {{ session('status') }}
        </div>
    @endif

    <p>Добро пожаловать, {{ auth()->user()->name }}!</p>

    <!-- <a href="{{ route('admin.stats') }}" class="btn btn-primary">Статистика</a> -->
@endsection