@extends('layouts.app')

@section('title', 'Аккаунт на модерации')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Аккаунт на модерации</h4>
                </div>
                <div class="card-body text-center">
                    <p class="lead">Здравствуйте, {{ $user->name }}!</p>
                    <p>Ваш аккаунт находится на рассмотрении администратора.</p>
                    <p>Пожалуйста, подождите подтверждения.</p>
                    <p class="text-muted">Если прошло много времени, свяжитесь с администратором по почте admin@bk.ru.</p>
                    <a href="{{ route('logout') }}" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection