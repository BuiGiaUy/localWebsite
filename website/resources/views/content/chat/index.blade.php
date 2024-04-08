@extends('layouts.chatLayout')
@section('title')
    Chat Room
@endsection
@section('content')
    <div class="grid grid-cols-3 gap-1 h-full">
        <!-- column 2-->
        <div class="col-span-2 h-full bg-[#202441] text-white text-base w-full pl-12 pr-12 py-8">
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
                        <button data-room-id="{{ $room->id }}" class="room-button w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
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
{{--                                @include('components.countNotification', ['number' => 1])--}}
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="w-ful pl-4 mt-12">
                <p class="font-semibold">Joined rooms</p>
                <div class="w-full" id="joined_rooms_list">
                    @foreach($joined_rooms as $room)
                        <button data-room-id="{{ $room->id }}" class="room-button w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
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
{{--                                @include('components.countNotification', ['number' => 1])--}}
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- column 3 -->
        <div class="col-span-1 w-full h-full bg-[#212540] pl-12 pr-12 py-8 relative">
            <div class="grid-rows-8 grid w-full h-full relative  ">
                <div class=" w-full h-full bg-[#212540] row-span-1 ">
                    <div class="flex " id="title_room_name">
                        <div class="col-span-1 w-full h-full bg-[#212540]  flex ">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-8 h-8 rounded-full">
                                    @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                </div>
                            </div>
                            <div >
{{--                                <div class="text-white font-bold ">Avatar Name</div>--}}
{{--                                <div class="text-gray-300">First line of text</div>--}}
                            </div>
                        </div>
                        <!-- Các thành phần khác -->
                        <button onclick="exitRoom()" class="text-white ml-4 focus:outline-none text-xl"><i class="fa-solid fa-right-from-bracket"></i></button>

                    </div>
                </div>
                <form id="" class="w-full h-full bg-[#212540] row-span-1 py-4 flex items-center">
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
                <div class=" w-full h-full  text-white row-span-6 ">
                    <div class="w-full" id="users_list">
                        {{--                            @include('components.userList', ['users' => $users, 'room'=> $room])--}}

                    </div>
                </div>
                <div class="text-center w-full row-span-1" id="link_room">

{{--                    <a href="#" class="mx-auto inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Open Chat</a>--}}
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
                        console.log(response)
                        if (!room)  return;

                        if (room.icon === null){
                            room.icon = '/images/avatar.jpg';
                        }
                        if (room.description == null){
                            room.description = '';
                        }
                        let html =
                            `<button data-room-id="${room.id}" class="room-button w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
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
                            </button>`;

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
    <script>
        $(document).ready(function() {
            getRoomUsers(1)
            $('.room-button').click(function() {
                // Get the room ID from the data-room-id attribute of the clicked button
                let roomId = $(this).data('room-id');

                // Call the getRoomUsers function with the room ID
                getRoomUsers(roomId);

            });


            function getRoomUsers(roomId) {
                console.log('Getting room users for room ID:', roomId);
                if (!roomId) {
                    roomId = 1;
                }

                $.ajax({
                    url: `/chat-room/room/${roomId}/users`,
                    type: 'GET',
                    success: function(response) {
                        // Dynamically generate HTML markup based on the received data
                        let usersHtml = '';
                        let titleNameRoomHtml = ''
                        let linkRoom = ''
                        console.log(response)
                        let description = response.room.description
                        if (description === null) {
                            description =''
                        }
                        titleNameRoomHtml =`
                            <div class="col-span-1 w-full h-full bg-[#212540]  flex ">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                    </div>
                                </div>
                                <div >
                                    <div class="text-white font-bold ">${response.room.name}</div>
                                    <div class="text-gray-300">${description} </div>
                                </div>
                            </div>
                            <!-- Các thành phần khác -->
                            <button onclick="exitRoom(${response.room.id})" class="text-white ml-4 focus:outline-none text-xl"><i class="fa-solid fa-right-from-bracket"></i></button>
                        `
                        linkRoom = `
                            <a href="/chat-room/chat/${response.room.id}"  class="btn-link-room mx-auto inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Open Chat</a>
                        `

                        if (response.room.owner) {
                            usersHtml += `
                                 <div class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                                    <div class="col-span-1 flex items-center space-x-4">
                                        <div class="w-8 h-8 rounded-full">
                                            <img src="${response.room.owner.icon || 'images/avatar.jpg'}" alt="Avatar">
                                        </div>
                                        <p class="font-bold">${response.room.owner.name}</p>
                                    </div>
                                    <div class="col-span-2 flex items-center justify-center">
                                        <div class="text-sm font-semibold text-gray-400">${response.room.owner ? 'Group Leader' : ''}</div>
                                    </div>
                                 </div>
                            `;
                        }
                        response.users.forEach(function(user) {

                            usersHtml += `
                                 <div class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                                    <div class="col-span-1 flex items-center space-x-4">
                                        <div class="w-8 h-8 rounded-full">
                                            <img src="${user.icon || 'images/avatar.jpg'}" alt="Avatar">
                                        </div>
                                        <p class="font-bold">${user.name}</p>
                                    </div>
                                    <div class="col-span-2 flex items-center justify-center">
                                        <div class="text-sm font-semibold text-gray-400">${response.room.owner.id === user.id ? 'Group Leader' : ''}</div>
                                    </div>
                                 </div>
                            `;

                        });

                        // Update the HTML content of the users list container
                        $('#users_list').html(usersHtml);
                        $('#title_room_name').html(titleNameRoomHtml);
                        $('#link_room').html(linkRoom);

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

        });
    </script>
    <script>
        function exitRoom(roomId) {

            console.log(roomId)
            $.ajax({
                url: `/chat-room/delete-room/${roomId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(result) {
                    window.location.href = "{{ route('room.index') }}";
                },
                error: function(xhr, status, error) {
                    alert('Error');
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
{{--    NotificationModal--}}

@endsection
