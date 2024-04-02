@foreach($users as $user)
    <div  class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
        <div class="col-span-1">
            <div class="flex justify-start items-center gap-4">
                <div class="w-8 h-8 rounded-full">
                    @include('components.avatar', ['avatar_path' => $user->icon ?? 'images/avatar.jpg'])
                </div>
                <p class="font-bold">{{$user->name}}</p>
            </div>
        </div>
    </div>
@endforeach
