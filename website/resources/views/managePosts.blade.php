<!-- resources/views/managePosts.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Quản Lý Bài Viết</h1>
    <ul>
        @foreach ($posts as $post)
            <li>
                <p>Nội Dung: {{ $post->Content }}</p>
                <p>Chủ Đề: {{ $post->TopicID }}</p>
                <p>Người Đăng: {{ $post->Username }}</p>
                <p>Ngày Đăng: {{ $post->CreatedAt }}</p>
                <!-- Thêm các thông tin khác về bài viết nếu cần -->
            </li>
        @endforeach
    </ul>
@endsection
