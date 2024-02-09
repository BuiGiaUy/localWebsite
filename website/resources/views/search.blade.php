<!-- resources/views/search.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Kết Quả Tìm Kiếm</h1>
    @if ($topics->isEmpty())
        <p>Không tìm thấy kết quả phù hợp.</p>
    @else
        <ul>
            @foreach ($topics as $topic)
                <li>
                    <a href="{{ route('forum.topic', $topic->TopicID) }}">{{ $topic->Title }}</a> -
                    {{ $topic->CategoryName }} ({{ $topic->Username }}) -
                    {{ $topic->CreatedAt }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
