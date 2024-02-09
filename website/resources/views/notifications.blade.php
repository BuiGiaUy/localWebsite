<!-- resources/views/notifications.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Thông Báo</h1>
    <ul>
        @foreach ($notifications as $notification)
            <li>{{ $notification->content }} - {{ $notification->createdAt }}</li>
        @endforeach
    </ul>
@endsection
