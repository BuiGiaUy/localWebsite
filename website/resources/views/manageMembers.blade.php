<!-- resources/views/manageMembers.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Quản Lý Thành Viên</h1>
    <ul>
        @foreach ($members as $member)
            <li>
                <p>Tên Đăng Nhập: {{ $member->username }}</p>
                <p>Email: {{ $member->email }}</p>
                <p>Ngày Tham Gia: {{ $member->joinDate }}</p>
                <!-- Thêm các thông tin khác về thành viên nếu cần -->
            </li>
        @endforeach
    </ul>
@endsection

