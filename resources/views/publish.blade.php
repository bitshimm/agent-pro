<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $user->name }}</title>

    <link rel="stylesheet" href="/css/fontawesome/css/brands.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/regular.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="/css/publish/style.css">
</head>

<body class="body-background">
    <div class="header">

    </div>
    <div class="content">
        <div class="widget_wrapper">
            <div class="widget">
                {{-- {!! $user->widget !!} --}}
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
                            <div class="article_btn">
                                Подробнее
                            </div>
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
        <div class="images_wrapper swiper-container">
            <div class="images swiper-wrapper">
                @foreach ($user->images as $image)
                    <div class="image swiper-slide">
                        <img src="{{ $image->path_full }}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            spaceBetween: 10,
            slidesPerView: 5,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                480: {
                    slidesPerView: 2,
                },
                640: {
                    slidesPerView: 3,
                },
                880: {
                    slidesPerView: 4,
                },
                960: {
                    slidesPerView: 5,
                }
            }
        });
    </script>
</body>

</html>
