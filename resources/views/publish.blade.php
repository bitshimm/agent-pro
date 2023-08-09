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

    </div>
    <div class="content">
        <div class="widget_wrapper">
            <div class="widget">

            </div>
        </div>
        <div class="articles_wrapper">
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
                        <div class="article_bottom">
                            <div class="article_btn modal_btn" modal-btn-id="{{ $article->id }}" modal-btn-group="articles">
                                Подробнее
                            </div>
                        </div>
                    </div>
                    <div class="modal_wrapper" modal-id="{{ $article->id }}" modal-group="articles">
                        <div class="modal">
                            <div class="modal_header">
                                <h1>{{ $article->title }}</h1>
                            </div>
                            <div class="modal_content">
                                {{ $article->content }}
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae facilis,
                                    accusamus sit, ex officiis reprehenderit architecto rem dicta dolorum, corrupti
                                    fugit similique itaque natus? Sit dolor labore voluptates nostrum dicta at
                                    temporibus fugit nulla, esse quod eum perferendis facilis doloribus officia
                                    molestias! Accusamus, nesciunt atque cum quod debitis quidem velit ea porro aliquid
                                    ad dicta quis sint, exercitationem quae tempora esse molestias voluptate voluptatum
                                    illum fugit dolore eos tenetur? Fugiat dolor dolore a nemo nihil, praesentium quae,
                                    fuga vel amet corporis rem nostrum dolorum quos expedita impedit laudantium odio
                                    obcaecati laborum mollitia quod? Quibusdam ipsa earum, accusamus consequuntur ullam
                                    nostrum.</p>
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
                <div class="about_full_description">
                    {{ $user->about_full_description }}
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

    <div class="footer">
        @foreach ($user->socialNetworks as $social_network)
            <a href="{{ $social_network->pivot->link }}" target="_blank">
                {!! $social_network->icon !!}
            </a>
        @endforeach
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

            function toggleModal(modalId, modalGroup) {
                const modal = document.querySelector('.modal_wrapper[modal-id="' + modalId + '"][modal-group="'+modalGroup+'"]');

                if (modal.classList.contains('modal_open')) {
                    modal.classList.remove("modal_open");
                } else {
                    modal.classList.add("modal_open");
                }
            }

            modalBtns.forEach(btnEl => {
                btnEl.addEventListener('click', () => {
                    const id = btnEl.getAttribute('modal-btn-id');
                    const group = btnEl.getAttribute('modal-btn-group');
                    toggleModal(id, group);
                });
            });

            modalWrappers.forEach(wrapperEl => {
                wrapperEl.addEventListener('click', (e) => {
                    const modal = wrapperEl.querySelector('.modal');
                    const id = wrapperEl.getAttribute('modal-id');
                    const group = wrapperEl.getAttribute('modal-group');
                    if (!e.composedPath().includes(modal)) {
                        toggleModal(id, group);
                    }
                });
            });
        });
    </script>
</body>

</html>
