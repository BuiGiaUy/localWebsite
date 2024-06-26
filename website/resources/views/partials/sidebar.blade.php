<div class="w-full py-8 px-4 ">

    <div class="flex justify-start items-center relative gap-4">
        <div class="w-12 h-12 rounded-full">
            @include('components.avatar', ['avatar_path' => 'images/avatar.jpg'])
        </div>
        <div class="font-bold text-lg text-white">
            @guest()
                <p>Guest</p>
            @else
                <p>{{Auth::user()->name}}</p>
            @endguest
        </div>
        <button onclick="showNotificationModal('New Notification', 'This is a new notification!')" class="absolute  right-0">
            <div class=" w-6 h-6 bg-red-500 rounded-full flex justify-center items-center text-white font-bold">1</div>
        </button>
        @include('components.modals.notificationModal')

    </div>
</div>
<!-- Navigation  menus -->
<div class="w-full py-4 px-6 text-white font-semibold">
    <div class="flex justify-between items-center py-2">
        <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#">
            <i class="fa-solid fa-house"></i>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="flex justify-between items-center py-2">
        <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#" >
            <i class="fa-solid fa-users"></i>
            <p>Chat Room</p>
        </a>
{{--        @include('components.countNotification', ['number' => 1])--}}
    </div>
    <div class="flex justify-between items-center py-2">
        <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#">
            <i class="fa-solid fa-calendar-days"></i>
            <p>Calendar</p>
        </a>
{{--        @include('components.countNotification', ['number' => 1])--}}
    </div>
</div>

<!-- Setting and Logout -->
<div class="w-full absolute bottom-0 py-8 px-6 text-white font-semibold">
    <a class="flex justify-start items-center gap-4 py-2 hover:text-red-500" href="#">
        <i class="fa-solid fa-gear"></i>
        <p>Setting</p>
    </a>
    <a href="{{ route('logout') }}" class="flex justify-start items-center gap-4 py-2 hover:text-red-500"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket"></i>
        <p> Logout</p>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
<script>
    function showNotificationModal(title, content) {
        document.getElementById('notificationContent').innerText = content;
        document.getElementById('notificationModal').classList.remove('hidden');
    }

    // Đóng modal
    function closeNotificationModal() {
        document.getElementById('notificationModal').classList.add('hidden');
    }
</script>
