@extends('layouts.app')

@section('content')
    <h1>Выданные ссылки</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Webmaster</th>
                <th>Offer</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->webmaster->name }}</td>
                    <td>{{ $log->offer->name }}</td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ $log->user_agent }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
@endsection