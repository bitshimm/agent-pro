<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $user->name }}</title>

    <link rel="stylesheet" href="/css/fontawesome/css/brands.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/regular.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="/css/publish/style.css">
    <link rel="stylesheet" href="/js/fancybox/fancybox.min.css" />
</head>

<body class="body-background">
    <div class="header">
        <nav class="nav">
            <div class="navbar">
                <button class="navbar-toggler"><i class="fas fa-bars"></i></button>
                <div class="navbar-brand">
                    <a href="#"><img src="https://via.placeholder.com/200x100.png/0066ff?text=logotype"
                            alt=""></a>
                </div>
                <div class="navbar-phone">
                    <a href="#"><i class="fas fa-phone-alt"></i></a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        @foreach ($user->articles as $article)
                            <li class="nav-item">
                                <a data-target="#navpages-{{ $article->id }}" class="modal_btn">{{ $article->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="navbar-contacts">
                    <a href="#">+79999999999</a>
                    <a href="#">testagent@mail.ru</a>
                </div>
            </div>
        </nav>
    </div>
    @foreach ($user->articles as $article)
        <div class="modal_wrapper" id="navpages-{{ $article->id }}">
            <div class="modal">
                <div class="modal_header">
                    <h1>{{ $article->title }}</h1>
                    <button class="btn_close"></button>
                </div>
                <div class="modal_body">
                    {{ $article->content }}
                </div>
                {{-- <div class="modal_footer"></div> --}}
            </div>
        </div>
    @endforeach
    <div class="content">
        <div class="widget_wrapper">
            <div class="widget">
                {{-- {!! $user->widget !!} --}}
            </div>
        </div>
        <div class="articles_wrapper">
            <div class="articles_wrapper_head">
                <span>Новости</span>
            </div>
            <div class="articles">
                @foreach ($user->articles as $article)
                    <div class="article">
                        <div class="article_head">
                            <span class="article_date">{{ $article->created_at->format('d/m/Y') }}</span>
                            @if ($article->image)
                                <img src="{{ $article->image }}" alt="{{ $article->alt }}">
                            @endif
                        </div>
                        <div class="article_title">
                            {{ $article->title }}
                        </div>
                        <div class="article_hr"></div>
                        <div class="article_bottom">
                            <div class="article_btn modal_btn" data-target="#articles-{{ $article->id }}">
                                Подробнее
                            </div>
                        </div>
                    </div>
                    <div class="modal_wrapper" id="articles-{{ $article->id }}">
                        <div class="modal">
                            <div class="modal_header">
                                <h1>{{ $article->title }}</h1>
                                <button class="btn_close"></button>
                            </div>
                            <div class="modal_body">
                                {{ $article->content }}
                            </div>
                            {{-- <div class="modal_footer"></div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="about_wrapper">
            <div class="about">
                <div class="about_title">
                    {{ $user->about_title }}
                </div>
                <div class="about_short_description">
                    {{ $user->about_short_description }}
                </div>
                <div class="about_bottom">
                    <div class="about_btn modal_btn" data-target="#about-{{ $user->id }}">Читать далее</div>
                </div>
            </div>
        </div>
        <div class="modal_wrapper" id="about-{{ $user->id }}">
            <div class="modal">
                <div class="modal_header">
                    <h1>{{ $user->about_title }}</h1>
                    <button class="btn_close"></button>
                </div>
                <div class="modal_body">
                    {!! $user->about_full_description !!}
                </div>
            </div>
        </div>
        <div class="images_container">
            <div class="images_wrapper" data-glide-el="track">
                <div class="images f-carousel">
                    @foreach ($user->images as $image)
                        <a class="image f-carousel__slide" data-caption="{{ $image->caption }}" data-fancybox="images"
                            data-src="{{ $image->path_full }}">
                            <img src="{{ $image->path_full }}" alt="{{ $image->alt }}">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow glide__arrow-prev" data-glide-dir="<">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </button>
                <button class="glide__arrow glide__arrow-next" data-glide-dir=">">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                        <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="footer_wrapper">
        <div class="footer">
            @foreach ($user->socialNetworks as $social_network)
                <a href="{{ $social_network->pivot->link }}" target="_blank">
                    {!! $social_network->icon !!}
                </a>
            @endforeach
        </div>
    </div>
    <script type="text/javascript" src="/js/lazysizes/lazysizes.min.js"></script>

    <script src="/js/fancybox/fancybox.min.js"></script>

    <script src="/js/glidejs/glidejs-3.6.0.min.js"></script>

    <script>
        Fancybox.bind('[data-fancybox="images"]', {
            Thumbs: false,
            Toolbar: {
                display: {
                    left: [],
                    middle: [],
                    right: ["download", "close"],
                },
            },
        });

        new Glide('.images_container', {
            type: 'carousel',
            carousel: 'images_wrapper',
            perView: 5,
            breakpoints: {
                1024: {
                    perView: 4,
                },
                880: {
                    perView: 3,
                },
                640: {
                    perView: 2,
                },
                480: {
                    perView: 1,
                },
            },
        }).mount();

        document.addEventListener("DOMContentLoaded", function() {
            const modalBtns = document.querySelectorAll('.modal_btn');
            const modalWrappers = document.querySelectorAll('.modal_wrapper');
            const navbarToggles = document.querySelector('.navbar-toggler');

            navbarToggles.addEventListener('click', () => {
                const collapseBlock = document.querySelector('.navbar-collapse');
                if (collapseBlock.classList.contains('show')) {
                    // collapseBlock.classList.remove('collapse');
                    // collapseBlock.classList.add('collapsing');
                    collapseBlock.classList.remove('show');
                } else {
                    collapseBlock.classList.add('show');
                }
            });

            function openModal(selector) {
                const modal = document.querySelector(selector);

                if (!document.body.classList.contains('modal-open') && !modal.classList.contains('show')) {
                    modal.classList.add("show");
                    document.body.classList.add("modal-open");
                }
            }

            function closeModal(selector) {
                const modal = document.querySelector(selector);

                if (modal.classList.contains('show') && document.body.classList.contains('modal-open')) {
                    modal.classList.remove("show");
                    document.body.classList.remove("modal-open");
                }
            }

            modalBtns.forEach(btnEl => {
                btnEl.addEventListener('click', () => {
                    const selector = btnEl.getAttribute('data-target');
                    openModal(selector);
                });
            });

            modalWrappers.forEach(wrapperEl => {
                wrapperEl.addEventListener('click', (e) => {
                    const modal = wrapperEl.querySelector('.modal');
                    const selector = wrapperEl.getAttribute('id');
                    const closeBtn = wrapperEl.querySelector('.btn_close');
                    if (!e.composedPath().includes(modal) || e.composedPath().includes(closeBtn)) {
                        closeModal('#' + selector);
                    }
                });
            });
        });
    </script>
</body>

</html>
