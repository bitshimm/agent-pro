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
                {!! $user->widget !!}
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
        <div class="images_container">
            <div class="images_wrapper" data-glide-el="track">
                <div class="images">
                    @foreach ($user->images as $image)
                        <div class="image">
                            <img src="{{ $image->path_full }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow glide__arrow--prev" data-glide-dir="<">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path d="M0 12l10.975 11 2.848-2.828-6.176-6.176H24v-3.992H7.646l6.176-6.176L10.975 1 0 12z">
                        </path>
                    </svg>
                </button>
                <button class="glide__arrow glide__arrow--next" data-glide-dir=">">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"></path>
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
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script>
        new Glide('.images_container', {
            type: 'carousel',
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
    </script>
</body>

</html>
