@extends('layouts.app')

@section('content')
    <h1>Создать нового пользователя</h1>

    <form method="POST" action="{{ route('admin.create-user') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Роль</label>
            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="">Выберите роль</option>
                <option value="advertiser" {{ old('role') == 'advertiser' ? 'selected' : '' }}>Advertiser</option>
                <option value="webmaster" {{ old('role') == 'webmaster' ? 'selected' : '' }}>Webmaster</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Поле для статуса TODO админ выбирает? -->
        <div class="mb-3">
            <label for="status" class="form-label">Статус</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Создать пользователя</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection