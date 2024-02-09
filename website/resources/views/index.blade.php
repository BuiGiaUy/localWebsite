<!-- resources/views/forum/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Danh sách Chủ đề</h1>
    <ul>
        @foreach ($topics as $topic)
            <li>
                <a href="{{ route('forum.topic', $topic->TopicID) }}">{{ $topic->Title }}</a> -
                {{ $topic->CategoryName }} ({{ $topic->Username }}) -
                {{ $topic->CreatedAt }}
            </li>
        @endforeach
    </ul>
@endsection
