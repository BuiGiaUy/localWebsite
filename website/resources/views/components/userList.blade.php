@if($room->owner->id)
    <div class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
        <!-- User is the group leader -->
        <div class="col-span-1 flex items-center space-x-4">
            <div class="w-8 h-8 rounded-full">
                @include('components.avatar', ['avatar_path' => $room->owner->icon ?? 'images/avatar.jpg'])
            </div>
            <p class="font-bold">{{ $room->owner->name }}</p>
        </div>
        <div class="col-span-2 flex items-center justify-center">
            <div class="text-sm font-semibold text-gray-400">Group Leader</div>
        </div>
    </div>
@endif
@foreach($users as $user)
    <div class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
        <div class="col-span-1 flex items-center space-x-4">
            <div class="w-8 h-8 rounded-full">
                @include('components.avatar', ['avatar_path' => $user->icon ?? 'images/avatar.jpg'])
            </div>
            <p class="font-bold">{{ $user->name }}</p>
        </div>
        <div class="col-span-2 flex items-center justify-center">
        </div>
    </div>
@endforeach
