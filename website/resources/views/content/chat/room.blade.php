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
                                <div class="text-white font-bold ">{{$room->name}}</div>
                                <div class="text-gray-300">{{$room->decription}}</div>
                            </div>
                        </div>
                        <!-- Các thành phần khác -->
                    </div>
                </div>
                <div class="flex-grow p-4 h-60">
                    <div class="w-full mx-auto h-full overflow-y-scroll">
                        <div class="bg-white h-full w-full rounded-lg shadow-md" id="message">
                            @if($messages->isEmpty())
                                <div class="text-gray-600 text-center py-4">Let's kick off the conversation! </div>
                                <div class="text-gray-600 text-center ">Send the first message to get things rolling.</div>
                            @else
                                @foreach($messages as $message)
                                    @if ($message->user_id == Auth::id())
                                        <!-- Tin nhắn của bạn -->
                                        <div class="flex items-center bg-white p-4  border-b relative" data-message-id="{{ $message->id }}">
                                            <div class="ml-3 flex-grow text-right pr-2">
                                                <div class="text-sm text-gray-800 font-semibold">Bạn</div>
                                                @if ($message->type === 'image')
                                                    <img src="{{ $message->content }}" alt="Tin nhắn ảnh">
                                                @elseif ($message->type === 'text')
                                                    <div class="text-gray-600">{{ $message->content }}</div>
                                                @endif
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 rounded-full">
                                                    @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                                </div>
                                            </div>
                                            <!-- Context menu -->
                                            <div class="absolute left-0 top-1/4 w-1/4 ">
                                                <div>
                                                    <div id="context-menu-{{ $message->id }}" class="z-30 hidden absolute bg-white border rounded shadow-lg">
                                                        <button class="absolute top-0 right-0 px-3 py-2" onclick="toggleContextMenu('{{ $message->id }}')">
                                                            <svg class="w-6 h-6 fill-current text-gray-500 hover:text-gray-700" viewBox="0 0 24 24">
                                                                <path d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                        <ul class="divide-y divide-gray-200 ">
                                                            <li>
                                                                <button onclick="openModal('editMessageModal{{ $message->id }}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">Edit Message</button>
                                                            </li>
                                                            <li>
                                                                <a  onclick="openModal('deleteConfirmationModal{{ $message->id }}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">Delete Message</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black opacity-10 z-20 hidden" onclick="toggleContextMenu('{{ $message->id }}')" ></div>
                                                </div>
                                                <button class="focus:outline-none" onclick="toggleContextMenu('{{ $message->id }}')">
                                                    <svg class="w-6 h-6 fill-current text-gray-500 hover:text-gray-700" viewBox="0 0 24 24">
                                                        <path d="M12 5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        @include('components.modals.editMessageModal',[ 'messages' => $messages])
                                        @include('components.modals.deleteConfirmationModal',[ 'messages' => $messages])
                                    @else
                                        <!-- Tin nhắn đến -->
                                        <div class="flex items-center bg-white p-4 border-b">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 rounded-full">
                                                    @include('components.avatar', ['avatar_path' => $message->user->avatar ?? 'images/avatar.jpg'])
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm text-gray-800 font-semibold">{{ $message->user->name }}</div>
                                                @if ($message->type === 'image')
                                                    <img src="{{ $message->content }}" alt="Tin nhắn ảnh">
                                                @elseif ($message->type === 'text')
                                                    <div class="text-gray-600">{{ $message->content }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex-none p-4 ">
                    <form class="flex items-center justify-between w-full bg-gray-800 p-4 rounded-lg" id="messageForm">
                        @csrf
                        <div class="flex-grow relative mr-4">
                            <label for="content" class="sr-only">Nội dung tin nhắn:</label>
                            <input name="content" type="text" id="content" data-room-id="{{$roomId}}"
                                   aria-label="Image" aria-describedby="button-image"
                                   class="form-control text-gray-900 w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-blue-500" placeholder="Nhập tin nhắn...">
                            <div id="memberList" class=" absolute text-gray-900 bg-white border border-gray-300 shadow-lg p-2 rounded-lg" style="display: none;">
                                <!-- Danh sách thành viên sẽ được hiển thị ở đây -->
                            </div>
                        </div>
                        <div class="mr-4">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-image"><i class="fa-solid fa-image"></i></button>
                                </div>
                            </div>
                        </div>
                        <button class="text-3xl px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none" type="submit"><i class="fa-solid fa-location-arrow"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- column 3 -->
        <div class="col-span-1 w-full h-full bg-[#212540] pl-12 pr-12 py-8">
            <div class="flex flex-col  ">
                <div class="w-full h-full bg-[#212540] col-span-1">
                    <div class="flex">
                        <div class="col-span-1 w-full h-full bg-[#212540] flex">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-8 h-8 rounded-full">
                                    @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                </div>
                            </div>
                            <div>
                                <div class="text-white font-bold">{{$room->name}}</div>
                                <div class="text-gray-300">{{$room->description}}</div>
                            </div>
                        </div>

                        <button onclick="exitRoom({{$roomId}})" class="text-white ml-4 focus:outline-none text-xl"><i class="fa-solid fa-right-from-bracket"></i></button>
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
                    <div class="w-full" id="users_list">
                        @include('components.userList', ['users' => $users, 'room'=> $room])
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
    <script>
        function toggleContextMenu(messageId) {
            let menu = document.getElementById('context-menu-' + messageId);
            let overlay = document.getElementById('overlay');
            menu.classList.toggle('hidden');
            overlay.classList.toggle('hidden');
        }
    </script>
    <script>
        let room_id = {{ $roomId }};
        Pusher.logToConsole = true;
        var pusher = new Pusher('3f38ceb0d245653f7b14', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('channel-'+ room_id);
        channel.bind('chat-event', function(data) {
            console.log(data.user.id)
            console.log({{ Auth::user()->id}})

            if (data.user.id !== {{ Auth::user()->id}}) {
                // alert(JSON.stringify(data));
                appendMessageEvent(data.message,data.user)
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#messageForm').submit(function(e) {
                e.preventDefault();
                console.log("Form submit!")
                $.ajax({
                    type: 'POST',
                    url: '{{ route("room.send-message", ['roomId' => $roomId]) }}',
                    data: $('#messageForm').serialize(),
                    success: function(response) {
                        console.log(response)
                        appendMessageSubmit(response.message, response.user)
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

        // set file link
        function fmSetLink($url) {
            // if (document.getElementById('content').type === 'text'){
            //     document.getElementById('content').type = 'type'
            // }
            // document.getElementById('content'). =  ;

            $url = $url.replace('http://localhost/', 'http://localwebsite.th/');
            document.getElementById('content').value = $url;
        }
    </script>
    <script>
        // Bắt sự kiện click chuột phải trên tin nhắn
        document.querySelectorAll('.message').forEach(item => {
            item.addEventListener('contextmenu', event => {
                event.preventDefault();
                // Hiển thị context menu
                const contextMenu = document.getElementById('context-menu');
                contextMenu.style.left = event.pageX + 'px';
                contextMenu.style.top = event.pageY + 'px';
                contextMenu.classList.remove('hidden');
                // Lưu id của tin nhắn được chọn
                contextMenu.dataset.messageId = item.dataset.messageId;

                document.querySelectorAll('.message').forEach(message => {
                    message.classList.remove('selected');
                });
                // Thêm lớp 'selected' vào tin nhắn được chọn
                item.classList.add('selected');
            });
        });

        // Bắt sự kiện click chuột ngoài context menu để ẩn nó đi
        document.addEventListener('click', event => {
            const contextMenu = document.getElementById('context-menu');
            if (!contextMenu.contains(event.target)) {
                contextMenu.classList.add('hidden');
            }
        });

        function deleteMessage(messageId) {
            console.log('/chat-room/delete-message/${messageId}')
            $.ajax({
                url: `/chat-room/delete-message/`+ messageId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success, maybe redirect or refresh page
                    console.log('Message has been deleted successfully');
                    closeModal('deleteConfirmationModal'+ messageId)
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('An error occurred:', error);
                    closeModal('deleteConfirmationModal'+ messageId)
                }
            });
        }

    </script>
    <script>
        // // Global variables to store search value and flag for tagging mode

        //
        // // Function to display user list in an absolute div
        // function displayMemberList(users) {
        //     let memberList = '';
        //     users.forEach(user => {
        //         memberList += `<div class="user" data-name="${user.name}">${user.name}</div>`;
        //     });
        //     $('#memberList').html(memberList);
        //     $('#memberList').show();
        // }
        //
        // // Function to handle keyup event
        // $(document).on('keyup', '#messageInput', function(event) {
        //
        //     if (event.key === '@') {
        //         isTaggingMode = true;
        //         searchValue = '@';
        //
        //         $.ajax({
        //             url: '/chat-room/room/${roomId}/users',
        //             type: 'GET',
        //             data: { query: '' },
        //             success: function(response) {
        //                 displayMemberList(response.users);
        //             },
        //             error: function(xhr) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     } else if (isTaggingMode && event.key === ' ') {
        //         isTaggingMode = false;
        //         $('#memberList').hide();
        //     } else if (isTaggingMode && event.key !== '@') {
        //         searchValue += event.key;
        //         // Call API to search for users based on searchValue
        //         $.ajax({
        //             url: '/chat-room/room/${roomId}/users',
        //             type: 'GET',
        //             data: { query: searchValue },
        //             success: function(response) {
        //                 displayMemberList(response.users);
        //             },
        //             error: function(xhr) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     }
        // });
        let searchValue = '';
        let isTaggingMode = false;

        // Bắt sự kiện click vào một người dùng từ danh sách
        $(document).on('click', '.user', function() {
            const selectedUserName = $(this).data('name');
            const messageInput = $('#content');
            const messageInputVal = messageInput.val(); // Gọi phương thức val() để lấy giá trị
            const currentMessage = messageInputVal;
            const atIndex = currentMessage.lastIndexOf('@');
            if (atIndex !== -1) {
                searchValue = currentMessage.slice(atIndex + 1, currentMessage.length);
            }
            const afterAt = currentMessage.slice(atIndex+1 + searchValue.length);
            messageInput.val(messageInputVal + selectedUserName + ' ' + afterAt);
            isTaggingMode = false;
            $('#memberList').hide();
        });

        $(document).ready(function() {
            const contentInput = document.getElementById('content');

            // Bắt sự kiện khi người dùng gõ phím trong trường nhập tin nhắn
            $(document).on('keyup', '#content', function(event) {
                const inputValue = event.target.value;
                const atIndex = inputValue.lastIndexOf('@');

                if (event.key === '@' && !isTaggingMode) {
                    isTaggingMode = true;
                    const roomId = contentInput.dataset.roomId;
                    searchValue = '@';
                    displayMemberList(roomId);
                } else if (event.key === ' ') {
                    isTaggingMode = false;
                    $('#memberList').hide();
                } else if (atIndex !== -1 && !isTaggingMode) {
                    isTaggingMode = true;
                    searchValue = '';
                }

                if (isTaggingMode && event.key !== ' ' && atIndex !== -1) {
                    searchValue += event.key;
                    const roomId = contentInput.dataset.roomId;
                    displayMemberList(roomId);

                    const cursorPosition = atIndex + 1;

                    $('#memberList').css({
                        'left': (cursorPosition * 8) + 'px'
                    });

                    $('#memberList').show();
                }
            });
        });

        function displayMemberList(roomId) {
            $.ajax({
                url: `/chat-room/room/${roomId}/users`,
                type: 'GET',
                success: function(response) {
                    let memberList = '';
                    let topValue = 45;
                    if (response.room.owner) {
                        memberList += `<div class="user" class="flex items-center justify-between px-4 py-2 border-b border-gray-200" data-name="${response.room.owner.name}">${response.room.owner.name}</div>`;
                    }
                    response.users.forEach(user => {
                        topValue += 20
                        memberList += `<div class="user" class="flex items-center justify-between px-4 py-2 border-b border-gray-200" data-name="${user.name}">${user.name}</div>`;
                    });
                    topValue += 20
                    memberList += `<div class="user" class="flex items-center justify-between px-4 py-2 border-b border-gray-200" data-name="All">@All</div>`;
                    $('#memberList').css('top','-'+ topValue + 'px');
                    $('#memberList').html(memberList);
                    $('#memberList').show();
                },
                error: function(xhr) {
                    // Xử lý lỗi khi yêu cầu AJAX thất bại
                    console.log(xhr.responseText);
                    alert('Error: Failed to retrieve member list.'); // Hiển thị thông báo lỗi (optional)
                }
            });
        }
    </script>
    <script>
        function exitRoom(id) {
            console.log(id)
            $.ajax({
                url: `/chat-room/delete-room/${id}`,
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
    <script>
        function appendMessageSubmit(message, user) {
            let html = '';

            if (message.user_id === {{ Auth::user()->id}}) {
                // Tin nhắn của bạn
                html +=
                    `<div class="flex items-center bg-white p-4 border-b relative" data-message-id="${message.id}">
                <div class="ml-3 flex-grow text-right pr-2">
                    <div class="text-sm text-gray-800 font-semibold">Bạn</div>`;
                if (message.type === 'image') {
                    html += `<img src="${message.content}" alt="Tin nhắn ảnh">`;
                } else if (message.type === 'text') {
                    html += `<div class="text-gray-600">${message.content}</div>`;
                }
                html +=
                    `</div>
            <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full">
                    <img src="{{asset('images/avatar.jpg')}}" alt="avatar" class="w-full h-full rounded-full"/>
                </div>
            </div>
            <!-- Context menu -->
            <div class="absolute left-0 top-1/4 w-1/4 ">
                <div>
                    <div id="context-menu-${message.id}" class="z-30 hidden absolute bg-white border rounded shadow-lg">
                        <button class="absolute top-0 right-0 px-3 py-2" onclick="toggleContextMenu('${message.id}')">
                            <svg class="w-6 h-6 fill-current text-gray-500 hover:text-gray-700" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <ul class="divide-y divide-gray-200 ">
                            <li>
                                <button onclick="openModal('editMessageModal${message.id}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">Edit Message</button>
                            </li>
                            <li>
                                <a onclick="openModal('deleteConfirmationModal${message.id}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">Delete Message</a>
                            </li>
                        </ul>
                    </div>
                    <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black opacity-10 z-20 hidden" onclick="toggleContextMenu('${message.id}')" ></div>
                </div>
                <button class="focus:outline-none" onclick="toggleContextMenu('${message.id}')">
                    <svg class="w-6 h-6 fill-current text-gray-500 hover:text-gray-700" viewBox="0 0 24 24">
                        <path d="M12 5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </button>
            </div>
            </div>
        </div>
        `;

                $('#message').append(html);
            }

        }

        function appendMessageEvent(message, user) {
            let html = ''
            html +=
                `                        <div class="ml-3 flex-grow text-right pr-2">
                            <div class="flex items-center bg-white p-4 border-b">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full">
                                        <img src="{{asset('images/avatar.jpg')}}" alt="avatar" class="w-full h-full rounded-full"/>
                                    </div>
                                </div>
                                <div class="ml-3">
                            <div class="text-sm text-gray-800 font-semibold">${user.name}</div>`;
            if (message.type === 'image') {
                html += `<img src="${message.content}" alt="Tin nhắn ảnh">`;
            } else if (message.type === 'text') {
                html += `<div class="text-gray-600">${message.content}</div>`;
            }

            html +=
                `</div>`;
            $('#message').append(html);
        }
    </script>
@endsection
