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
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">

    <link href="/css/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="/css/fontawesome/css/regular.min.css" rel="stylesheet">
    <link href="/css/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="/css/fontawesome/css/solid.min.css" rel="stylesheet">

    <script src="/js/tinymce/tinymce.min.js"></script>

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
    <div id="sidebar_overlay"></div>
    <div class="wrapper">
        <nav class="main_header">
            <ul class="navbar_nav">
                <li class="nav_item">
                    <a class="nav_link" href="#" id="menu-toggler">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav_item">
                    <a href="#" class="nav_link">
                        Home
                    </a>
                </li>
                <li class="nav_item">
                    <a href="#" class="nav_link">
                        Contact
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main_sidebar">
            {{-- <div class="user_panel">
                <a href="#">
                    <i class="fa-regular fa-user"></i>
                    <span>Profile</span>
                </a>
            </div> --}}
            <nav>
                <ul class="nav">
                    {{-- <li class="nav_item">
                        <x-nav-link-new :href="route('articles.index')" :active="request()->routeIs('articles.*')">
                            <i class="nav_icon fa-solid fa-newspaper"></i>
                            <span class="nav_title">Новости</span>
                        </x-nav-link-new>
                    </li>
                    <li class="nav_item">
                        <x-nav-link-new :href="route('images.index')" :active="request()->routeIs('images.*')">
                            <i class="nav_icon fa-solid fa-image"></i>
                            <span class="nav_title">Изображения</span>
                        </x-nav-link-new>
                    </li> --}}
                </ul>
            </nav>
        </aside>
        <div class="content_wrapper">
            <div class="content_header">
                @if (isset($header) || isset($insert_link))
                    <header>
                        {{ $header }}
                    </header>
                @endif
            </div>
            <div class="content">
                {{-- <textarea>Next, use our Get Started docs to setup Tiny!</textarea> --}}
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
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'ru',
            height: 800,
            plugins: [
                'fullscreen', 'template', 'code', 'image', 'preview', 'widget', 'callbackform'
            ],
            toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code',
            toolbar2: 'widget | callbackform',
            content_style: "p[id^='widget-'] { border: 1px solid #000; }",
        });
        const callbackformWrappers = document.querySelectorAll('p[id^="callbackform-"]');
        for (var i = 0; i < callbackformWrappers.length; i++) {
            console.log('callbackformWrappers: ', callbackformWrappers[i]);
            callbackformWrappers[i].innerHTML = '<h3>ТУТА ТИПА ФОРМА</h3>';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const btnToggler = document.getElementById('menu-toggler');
            const mainSidebar = document.querySelector('.main_sidebar');

            btnToggler.addEventListener("click", () => {
                document.body.classList.toggle('sidebar_collapse');
                let w_md = window.matchMedia("(max-width: 768px)");
                if (w_md.matches) {
                    document.body.classList.remove('sidebar_collapse')
                    if (document.body.classList.contains('sidebar_open')) {
                        document.body.classList.remove('sidebar_open');
                        document.body.classList.add('sidebar_close');
                    } else {
                        document.body.classList.remove('sidebar_close');
                        document.body.classList.add('sidebar_open');
                    }
                } else {
                    document.body.classList.remove('sidebar_open');
                    document.body.classList.remove('sidebar_close');
                }
            });

            mainSidebar.addEventListener('mouseover', (e) => {
                if (document.body.classList.contains('sidebar_collapse')) {
                    document.body.classList.remove('sidebar_close');
                    document.body.classList.add('sidebar_open');
                }
                // console.log(e.target.classList);
            });
            mainSidebar.addEventListener('mouseout', (e) => {
                if (document.body.classList.contains('sidebar_collapse')) {
                    document.body.classList.remove('sidebar_open');
                    document.body.classList.add('sidebar_close');
                }
                // console.log(e.target.classList);
            });
            window.addEventListener('click', (e) => {
                const target = e.target;
                if (!target.closest('.main_sidebar') && !target.closest('#menu-toggler')) {
                    document.body.classList.remove('sidebar_open');
                    document.body.classList.add('sidebar_close')
                }
            });
            window.addEventListener("resize", () => {
                let w_md = window.matchMedia("(min-width: 768px)");
                if (w_md.matches && document.body.classList.contains('sidebar_open')) {
                    document.body.classList.remove('sidebar_open');
                }
            });
        });
    </script>
</body>

</html>
