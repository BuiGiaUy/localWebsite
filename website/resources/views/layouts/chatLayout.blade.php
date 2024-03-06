<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('partials.head')
</head>
<body>
<div class="app h-screen w-full grid  grid-cols-6 text-base">
    <div class="col-span-1 w-full h-full bg-[#262948] relative">
        @include('partials.sidebar')
    </div>
    <div class="col-span-5 w-full h-full bg-[#3c425e]">
        @yield('content')
    </div>
</div>

@include('components.notification')
@include('partials.javascript')
</body>
</html>
