<!-- resources/views/sendMessage.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Gửi Tin Nhắn</h1>
    <form method="POST" action="{{ route('messages.send') }}">
        @csrf
        <div>
            <label for="receiver">Người Nhận:</label>
            <input type="text" name="receiver" id="receiver" required>
        </div>
        <div>
            <label for="content">Nội Dung:</label>
            <textarea name="content" id="content" rows="5" required></textarea>
        </div>
        <button type="submit">Gửi Tin Nhắn</button>
    </form>
@endsection
