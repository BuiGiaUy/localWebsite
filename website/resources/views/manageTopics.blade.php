<!-- resources/views/manageTopics.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Quản Lý Chủ Đề</h1>
    <ul>
        @foreach ($topics as $topic)
            <li>
                <p>Tiêu Đề: {{ $topic->Title }}</p>
                <p>Danh Mục: {{ $topic->CategoryName }}</p>
                <p>Người Tạo: {{ $topic->Username }}</p>
                <p>Ngày Tạo: {{ $topic->CreatedAt }}</p>
                <!-- Thêm các thông tin khác về chủ đề nếu cần -->
            </li>
        @endforeach
    </ul>
@endsection
