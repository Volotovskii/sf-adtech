@extends('layouts.app')

@section('content')
    <h1>Ожидающие подтверждения</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.approve-user', $user->id) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Одобрить</button>
                        </form>
                        <form method="POST" action="{{ route('admin.reject-user', $user->id) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Отклонить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection