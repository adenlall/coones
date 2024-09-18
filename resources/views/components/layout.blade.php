<html data-theme="cobones" dir="rtl">
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>{{ $title }} - كوبون على السريع</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-base-200">

<div class="drawer">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col">
        <!-- Navbar -->
        <div class="bg-base-100">
            <x-navbar />
        </div>
        <!-- Page content here -->
        {{ $slot }}
    
    </div>
    <div class="drawer-side z-50">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 gap-2">
            <form action="{{route('store.index')}}"  class="flex flex-row flex-nowrap">
                <input value="{{app('request')->input('search')}}" name="search" class="input input-bordered rounded-r-full rounded-l-none join-item" placeholder="البحث عن المتاجر والعروض" />
                <button type="submit" class="btn join-item rounded-l-full rounded-r-none btn-primary">بحث</button>
            </form>
            <x-nav-menu/>
        </ul>
    </div>
</div>
<x-footer/>
@vite('resources/js/app.js')
@stack('scripts')
</body>
</html>
