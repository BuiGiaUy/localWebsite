@extends('layouts.chatLayout')
@section('title')
    Chat
@endsection
@section('content')
    <div class="grid grid-cols-3 gap-1 h-full">
        <!-- column 2-->
        <div class="col-span-2 h-full bg-[#202441] text-white text-base w-full pl-6 pr-6 py-8">
            <div class="flex flex-col h-full">
                <div class="flex-none pr-4 pl-4 ">
                    <div class="flex ">
                        <div class="col-span-1 w-full h-full bg-[#212540] flex ">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-8 h-8 rounded-full">
                                    @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                </div>
                            </div>
                            <div>
                                <div class="text-white font-bold ">Avatar Name</div>
                                <div class="text-gray-300">First line of text</div>
                            </div>
                        </div>
                        <!-- Các thành phần khác -->
                    </div>
                </div>
                <div class="flex-grow p-4 ">
                    <div class=" w-full mx-auto h-full overflow-y-auto">
                        <div class="bg-white h-full w-full rounded-lg shadow-md overflow-hidden">
                            <!-- Tin nhắn đến -->
                            <div class="flex items-center p-4 border-b">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm text-gray-800 font-semibold">Người gửi 1</div>
                                    <div class="text-gray-600">Tin nhắn đến từ người gửi 1</div>
                                </div>
                            </div>
                            <!-- Tin nhắn đi -->
                            <div class="flex items-center p-4 border-b">
                                <div class="ml-3 flex-grow text-right pr-2">
                                    <div class="text-sm text-gray-800 font-semibold">Bạn</div>
                                    <div class="text-gray-600">Tin nhắn của bạn</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-none p-4 w-full">

                </div>
            </div>
        </div>
        <!-- column 3 -->
        <div class="col-span-1 w-full h-full bg-[#212540] pl-12 pr-12 py-8">
            <div class="flex flex-col  ">
                <div class=" w-full h-full bg-[#212540] col-span-1 ">
                    <div class="flex">
                        <div class="col-span-1 w-full h-full bg-[#212540]  flex ">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-8 h-8 rounded-full">
                                    @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                </div>
                            </div>
                            <div>
                                <div class="text-white font-bold ">Avatar Name</div>
                                <div class="text-gray-300">First line of text</div>
                            </div>
                        </div>
                        <!-- Các thành phần khác -->
                    </div>
                </div>
                <form id="" class="w-full h-full bg-[#212540] col-span-4 py-8 flex items-center">
                    @csrf
                    <!-- Form Title -->
                    <h3 class="text-2xl text-center font-bold pr-2 text-white">Search </h3>
                    <!-- Room Name -->
                    <div class="w-full relative">
                        <label for="search_room_name"></label>
                        <input type="text" name="search_room_name" id="search_room_name" required
                               placeholder="search message"
                               class="w-full py-1.5 px-4 border border-gray-400 rounded-lg  focus:outline-blue-600 "
                               autofocus
                        />
                        <button type="submit" class="absolute top-0 right-0 self-center h-full mr-4 text-blue-600">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                </form>
                <div class=" w-full h-full  text-white flex-grow py-8">
                    <div class="w-full" id="rooms_list">
                        @foreach($rooms as $room)
                            <div  class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                                <div class="col-span-1">
                                    <div class="flex justify-start items-center gap-4">
                                        <div class="w-8 h-8 rounded-full">
                                            @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                        </div>
                                        <p class="font-bold">{{$room->name}}</p>
                                    </div>
                                </div>

                                <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                                    <p class="text-gray-400">2 min ago</p>
                                    {{--                                @include('components.countNotification', ['number' => 1])--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- add New Room Form Modal -->
    @include('components.modals.roomFormModal')
    @include('components.modals.searchRoomModal')

    <!-- Import CDN jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Call Ajax handle -->
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
                        turnOnNotification(response.message, "success");
                        const room = response.room;
                        if (!room)  return;

                        if (room.icon === null){
                            room.icon = '/images/avatar.jpg';
                        }
                        if (room.description == null){
                            room.description = '';
                        }
                        let html =
                            `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        <img src="${room.icon}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                    </div>
                                    <p class="font-bold">${room.name}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p>${room.description}</p>
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
