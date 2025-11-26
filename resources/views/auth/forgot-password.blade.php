@extends('layouts.centered-form')

@section('title', 'Сброс пароля')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-header bg-warning text-dark text-center">
        <h4 class="mb-0">Сброс пароля</h4>
    </div>
    <div class="card-body">
        <div class="mb-4 text-center">
            <p>Забыли пароль? Нет проблем. Просто сообщите нам свой адрес электронной почты, и мы отправим вам ссылку для сброса пароля.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Отправить ссылку для сброса</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <p class="mb-0"><a href="{{ route('login') }}">Вернуться к входу</a></p>
        </div>
    </div>
</div>
@endsection