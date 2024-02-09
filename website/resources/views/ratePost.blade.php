<!-- resources/views/ratePost.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Đánh Giá Bài Viết</h1>
    <form method="POST" action="{{ route('posts.rate', $post->PostID) }}">
        @csrf
        <div>
            <label for="rating">Đánh Giá:</label>
            <select name="rating" id="rating">
                <option value="1">1 Sao</option>
                <option value="2">2 Sao</option>
                <option value="3">3 Sao</option>
                <option value="4">4 Sao</option>
                <option value="5">5 Sao</option>
            </select>
        </div>
        <button type="submit">Gửi Đánh Giá</button>
    </form>
@endsection
