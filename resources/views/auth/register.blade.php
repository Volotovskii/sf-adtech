@extends('layouts.centered-form')

@section('title', 'Регистрация')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-header bg-success text-white text-center">
        <h4 class="mb-0">Регистрация</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Подтверждение пароля</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <!-- выбор роли -->
            <div class="mb-3">
                <label for="role" class="form-label">Роль</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="advertiser">Рекламодатель</option>
                    <option value="webmaster">Веб-мастер</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Зарегистрироваться</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <p class="mb-0">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
        </div>
    </div>
</div>
@endsection