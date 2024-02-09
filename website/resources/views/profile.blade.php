<!-- resources/views/profile.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Thông Tin Thành Viên</h1>
    <p>Tên Đăng Nhập: {{ $user->username }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Ngày Tham Gia: {{ $user->joinDate }}</p>
    <!-- Thêm các thông tin khác về thành viên nếu cần -->
@endsection
