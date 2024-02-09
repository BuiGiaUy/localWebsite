<!-- resources/views/forum/topic.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>{{ $topic->Title }}</h1>
    <p>Người tạo: {{ $topic->Username }}</p>
    <p>Danh mục: {{ $topic->CategoryName }}</p>
    <p>Ngày tạo: {{ $topic->CreatedAt }}</p>

    <h2>Bài viết</h2>
    @foreach ($posts as $post)
        <div>
            <p>Người đăng: {{ $post->Username }}</p>
            <p>Nội dung: {{ $post->Content }}</p>
            <p>Ngày đăng: {{ $post->CreatedAt }}</p>
        </div>
    @endforeach
@endsection
