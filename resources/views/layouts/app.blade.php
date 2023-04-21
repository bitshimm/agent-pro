<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div> --}}
    <aside class="main_sidebar">
        <div class="user_panel">
            <a href="#">Profile</a>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav_item">
                    <x-nav-link-new :href="route('articles.index')" :active="request()->routeIs('articles.*')">
                        Новости
                    </x-nav-link-new>
                </li>
                <li class="nav_item">
                    <x-nav-link-new :href="route('images.index')" :active="request()->routeIs('images.*')">
                        Изображения
                    </x-nav-link-new>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="container_wrapper">
        @if (isset($header) || isset($insert_link))
            <header>
                {{ $header }}
            </header>
        @endif

        <div class="container">
            @if ($errors->all())
                <div class="alert alert-danger" style="background-color: #dc3545; color: #fff;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>
</body>

</html>
