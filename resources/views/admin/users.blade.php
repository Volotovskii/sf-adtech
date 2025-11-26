@extends('layouts.app')

@section('content')
    <h1>Пользователи</h1>
<a href="{{ route('admin.create-user.form') }}" class="btn btn-info me-2">Создать пользователя</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Статус</th> <!-- account_is_active -->
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if($user->account_is_active ?? true)
                            <span class="badge bg-success">Активен</span>
                        @else
                            <span class="badge bg-danger">Неактивен</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.toggle-user', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">
                                {{ ($user->account_is_active ?? true) ? 'Деактивировать' : 'Активировать' }} 
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    @vite(['resources/js/admin-users.js'])
@endpush