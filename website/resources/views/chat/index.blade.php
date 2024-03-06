
@extends('layouts.app')

@section('content')
    <div class="app h-screen w-full grid grid-cols-6 ">
        <div class="col-span-1 w-full h-full bg-[#26294B] ">
            <div class="w-full py-8 px-4">
                <div class="flex justify-start items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#3c425e]">
                        @include('components.avatar',['avatar_path' => 'images/avatar.jpg'])
                    </div>
                    <div class="font-bold text-lg text-white">
                        <p>{{Auth::user()->name}}</p>
                    </div>
                </div>
            </div>
            <div class="w-full py-4 px-6 text-white font-semibold ">
                <div class="flex justify-between items-center py-2 ">
                    <a class="flex justify-start items-center gap-3 hover:text-red-600" href="#">
                        <i class="fa-solid fa-house"></i>
                        <p>Dashboard</p>
                    </a>
                </div>
                <div class="flex justify-between items-center py-2 ">
                    <a class="flex justify-start items-center gap-3 hover:text-red-600" href="#">
                        <i class="fa-solid fa-comments"></i>
                        <p>Chat Room</p>
                    </a>
                    <div class="rounded-full bg-red-600 w-5 h-5 text-sm"><p class="justify-content-center flex">1</p></div>
                </div>
                <div class="flex justify-between items-center py-2 ">
                    <a class="flex justify-start items-center gap-3 hover:text-red-600" href="#">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p>Calendar</p>
                    </a>
                    <div class="rounded-full bg-red-600 w-5 h-5 text-sm">
                        <p class="justify-content-center flex">1</p>
                    </div>
                </div>
            </div>
            <div class="w-full h-12 absolute bottom-0 text-white font-semibold py-4 px-6">
                <div class="flex justify-start items-center gap-4 py-2 ">
                    <i class="fa-solid fa-gear"></i>
                    <p>Setting</p>
                </div>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <div class="flex justify-start items-center gap-4 py-2 " aria-labelledby="navbarDropdown">
                    <i class="fa-solid fa-right-from-bracket"></i>

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-5 w-full h-full ">
            <div class="grid grid-cols-2 gap-1 h-full bg-[#7c7d7e]">
                    <!-- column 2-->
                    <div class="col-span-1 h-full bg-[#202441] text-white text-base w-full pl-12 pr-12 py-8">
                        <div class="font-bold text-3xl flex justify-between">
                            <div class="flex justify-start items-center gap-4">
                                <i class="fa-solid fa-users"></i>
                                <p> Chat Room</p>
                            </div>
                            <div class="flex justify-end items-center gap-4">
                                <button type="button" onclick="openModal('searchRoomModal')" class="text-white hover:text-orange-400">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <button type="button" onclick="openModal('addNewRoomFormModal')" class="text-white hover:text-orange-400">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>

                        </div>
                        <div class="w-ful pl-4 mt-12">
                            <p class="font-semibold">My rooms</p>
                            <div class="w-full" id="rooms_list">
                                @foreach($rooms as $room)
                                    <a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                                        <div class="col-span-1">
                                            <div class="flex justify-start items-center gap-4">
                                                <div class="w-8 h-8 rounded-full">
                                                    @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                                </div>
                                                <p class="font-bold">{{$room->name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <p> {{$room->description}}</p>
                                        </div>
                                        <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                                            <p class="text-gray-400">2 min ago</p>

{{--                                            @include('components.countNotification', ['number' => 1])--}}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                <div class="col-span-1 h-full w-full bg-[#212540]">

                </div>
            </div>
        </div>
    </div>
    @include('components.roomFormModal')
    @include('components.searchRoomModal')
    <script>
        function openModal(modal_id) {
            console.log("open_modal")
            let addNewRoomFormModal = document.getElementById(modal_id)
            addNewRoomFormModal.classList.remove('hidden')
            addNewRoomFormModal.classList.add('visible')
        }
        function closeModal(modal_id) {
            console.log("close_modal")
            let addNewRoomFormModal = document.getElementById(modal_id)
            addNewRoomFormModal.classList.remove('visible')
            addNewRoomFormModal.classList.add('hidden')
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // Bắt sự kiện submit form
            $('#createRoomForm').submit(function(e) {
                e.preventDefault();
                console.log("Form submit!")
                $.ajax({
                    type: 'POST',
                    url: '{{ route("room.store") }}', // Găn route
                    data: $(this).serialize(), // Dữ liệu form
                    success: function(response) {
                        // Handle the success response
                        console.log(response);
                        // Modifine response
                        if (response.icon === null){
                            response.icon = '/images/avatar.jpg';
                        }
                        if (response.description == null){
                            response.description = '';
                        }
                        let html = '';
                        html +=
                            `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        <img src="${response.icon}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                    </div>
                                    <p class="font-bold">${response.name}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p>${response.description}</p>
                            </div>
                        </a>`;

                        // Add to top of room list
                        $('#rooms_list').prepend(html);

                        closeModal('addNewRoomFormModal');

                    },
                    error: function(error) {
                        // Handle the error response
                        console.log(error);
                        closeModal('addNewRoomFormModal');
                    },
                });

                $('#createRoomForm')[0].reset();
            });
        });
    </script>
@endsection
