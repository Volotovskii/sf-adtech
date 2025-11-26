@extends('layouts.app')

@section('content')
    <h1>Отказы редиректа</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Webmaster</th>
                <th>Offer</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Reason</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($failures as $failure)
                <tr>
                    <td>{{ $failure->webmaster->name ?? 'N/A' }}</td>
                    <td>{{ $failure->offer->name ?? 'N/A' }}</td>
                    <td>{{ $failure->ip_address }}</td>
                    <td>{{ $failure->user_agent }}</td>
                    <td>{{ $failure->reason }}</td>
                    <td>{{ $failure->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $failures->links() }}
@endsection