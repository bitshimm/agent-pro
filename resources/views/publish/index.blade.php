<!DOCTYPE html>
<html lang="ru">

<head>
    @include('publish.partials.head')
</head>

<body class="body-background">
    <div class="header">
        <nav class="nav">
            <div class="navbar">
                <button class="navbar-toggler">
                    <svg width="25" height="25" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 18L20 18" stroke-width="2.4" stroke-linecap="round"></path>
                        <path d="M4 12L20 12" stroke-width="2.4" stroke-linecap="round"></path>
                        <path d="M4 6L20 6" stroke-width="2.4" stroke-linecap="round"></path>
                    </svg>
                </button>
                <div class="navbar-brand">
                    <a href="/">
                        @if ($user->logotype)
                            <img width="200" src="{{ $user->logotype }}" alt="">
                        @endif
                    </a>
                </div>
                <div class="navbar-phone">
                    @if ($user->contact_phone)
                        <a href="tel:{{ $user->contact_phone }}"><i class="fas fa-phone-alt"></i></a>
                    @elseif($user->contact_phone_second)
                        <a href="tel:{{ $user->contact_phone_second }}"><i class="fas fa-phone-alt"></i></a>
                    @endif
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        @foreach ($user->articles as $article)
                            <li class="nav-item">
                                <a data-target="#navpages-{{ $article->id }}"
                                    class="modal_btn">{{ $article->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="navbar-contacts">
                    @if ($user->contact_phone)
                        <a href="tel:{{ $user->contact_phone }}">
                            <span class="navbar-contacts-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path
                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                </svg>
                            </span>
                            {{ $user->contact_phone }}
                        </a>
                    @endif
                    @if ($user->contact_phone_second)
                        <a href="tel:{{ $user->contact_phone_second }}">
                            <span class="navbar-contacts-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path
                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                </svg>
                            </span>
                            {{ $user->contact_phone_second }}
                        </a>
                    @endif
                    @if ($user->contact_email)
                        <a href="mailto:{{ $user->contact_email }}">
                            <span class="navbar-contacts-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                            </span>
                            {{ $user->contact_email }}
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    @foreach ($user->articles as $article)
        <div class="modal_wrapper" id="navpages-{{ $article->id }}">
            <div class="modal">
                <div class="modal_header">
                    <span class="modal_title">{{ $article->title }}</span>
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
        <div class="special_offers_wrapper">
            <div class="special_offers_collapse">
                <div class="special_offers_list">
                    @foreach ($user->specialOffers as $offer)
                        <a class="special_offers_el modal_btn" data-target="#specialOffers-{{ $offer->id }}">
                            <img src="{{ $offer->image }}" alt="">
						</a>
						<div class="modal_wrapper" id="specialOffers-{{ $offer->id }}">
							<div class="modal">
								<div class="modal_header">
									<span class="modal_title">{{ $offer->title }}</span>
									<button class="btn_close"></button>
								</div>
								<div class="modal_body">
									{!! $offer->content !!}
								</div>
								{{-- <div class="modal_footer"></div> --}}
							</div>
						</div>
                    @endforeach
                </div>
            </div>
            <div class="special_offers_header">
                <div class="special_offers_caption"></div>
                <div class="special_offers_toggler"></div>
            </div>
        </div>
        <div class="widget_wrapper">
            <div class="widget_title">
                <span class="widget_title_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path
                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                </span>
                Подобрать круиз
            </div>
            <div class="widget">
                {{-- {!! $user->widget !!} --}}
            </div>
        </div>
        <div class="articles_wrapper">
            <div class="articles_wrapper_head">
                <span>НОВОСТИ</span>
            </div>
            <div class="articles">
                @foreach ($articles as $article)
                    <div class="article">
                        <div class="article_head">
                            <span class="article_date">{{ $article->created_at->format('d/m/Y') }}</span>
                            @if ($article->image_thumb)
                                <img src="{{ $article->image_thumb }}" alt="{{ $article->title }}">
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
                                <span class="modal_title">{{ $article->title }}</span>
                                <button class="btn_close"></button>
                            </div>
                            <div class="modal_body">
                                {!! $article->content !!}
                            </div>
                            {{-- <div class="modal_footer"></div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if ($user->about_title && $user->about_short_description && $user->about_full_description)
            <div class="about_wrapper">
                <div class="about">
                    <div class="about_title">
                        {{ $user->about_title }}
                    </div>
                    <div class="about_short_description">
                        {{ $user->about_short_description }}
                    </div>
                    <div class="about_bottom">
                        <div class="about_btn modal_btn" data-target="#about-{{ $user->id }}">Читать далее
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal_wrapper" id="about-{{ $user->id }}">
                <div class="modal">
                    <div class="modal_header">
                        <span class="modal_title">{{ $user->about_title }}</span>
                        <button class="btn_close"></button>
                    </div>
                    <div class="modal_body">
                        {!! $user->about_full_description !!}
                    </div>
                </div>
            </div>
        @endif
        <div class="images_container">
            <div class="images_wrapper swiper" data-glide-el="track">
                <div class="images f-carousel swiper-wrapper">
                    @foreach ($user->images as $image)
                        <a class="image f-carousel__slide swiper-slide" data-caption="{{ $image->caption }}"
                            data-fancybox="images" data-src="{{ $image->path_full }}"
                            style="background-image: url('{{ $image->path_thumb }}');">

                            {{-- <img src="{{ $image->path_thumb }}"
                                @if ($image->alt) alt="{{ $image->alt }}"
                                @elseif($image->caption) alt="{{ $image->caption }}" @endif> --}}
                        </a>
                    @endforeach
                </div>

                <div class="images-button images-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </div>
                <div class="images-button images-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                        <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_wrapper">
        <div class="footer">
            <div id="footer-triangle">
                <svg width="30px" height="30px" viewBox="0 0 24.00 24.00" fill="none"
                    xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, 1, 0, 0)">
                    <path
                        d="M20.4086 9.35258C22.5305 10.5065 22.5305 13.4935 20.4086 14.6474L7.59662 21.6145C5.53435 22.736 3 21.2763 3 18.9671L3 5.0329C3 2.72368 5.53435 1.26402 7.59661 2.38548L20.4086 9.35258Z"
                        stroke-width="0.4800000000000001"></path>
                </svg>
            </div>
            <div class="footer_title">Наши контакты</div>
            <div class="footer_logotype">
                <a href="/">
                    @if ($user->logotype)
                        <img width="200" src="{{ $user->logotype }}" alt="">
                    @endif
                </a>
            </div>
            <div class="footer_contacts">
                @if ($user->contact_phone)
                    <a href="tel:{{ $user->contact_phone }}" class="footer_contact contact_phone">
                        <span class="footer-contacts-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <path
                                    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                            </svg>
                        </span>
                        <span class="footer-contact-value">
                            {{ $user->contact_phone }}
                        </span>
                    </a>
                @endif
                @if ($user->contact_phone_second)
                    <a href="tel:{{ $user->contact_phone_second }}" class="footer_contact contact_phone">
                        <span class="footer-contacts-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <path
                                    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                            </svg>
                        </span>
                        <span class="footer-contact-value">
                            {{ $user->contact_phone_second }}
                        </span>
                    </a>
                @endif
                @if ($user->contact_email)
                    <a href="mailto:{{ $user->contact_email }}" class="footer_contact">
                        <span class="footer-contacts-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <path
                                    d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                            </svg>
                        </span>
                        <span class="footer-contact-value">
                            {{ $user->contact_email }}
                        </span>
                    </a>
                @endif
                @if ($user->contact_address)
                    <span class="footer_contact">
                        <span class="footer-contacts-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                <path
                                    d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                            </svg>
                        </span>
                        <span class="footer-contact-value">
                            {{ $user->contact_address }}
                        </span>
                    </span>
                @endif
                @if ($user->contact_opening_hours)
                    <span class="footer_contact">
                        <span class="footer-contacts-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <path
                                    d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                            </svg>
                        </span>
                        <span class="footer-contact-value">
                            {{ $user->contact_opening_hours }}
                        </span>
                    </span>
                @endif
                @if ($user->socialNetworks->count())
                    <span class="footer_contact">
                        <span class="footer-contacts-icon">
                            <svg width="16px" height="16px" viewBox="0 0 32 32"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Icon-Set" transform="translate(-100.000000, -255.000000)">
                                    <path
                                        d="M116,281 C114.832,281 113.704,280.864 112.62,280.633 L107.912,283.463 L107.975,278.824 C104.366,276.654 102,273.066 102,269 C102,262.373 108.268,257 116,257 C123.732,257 130,262.373 130,269 C130,275.628 123.732,281 116,281 L116,281 Z M116,255 C107.164,255 100,261.269 100,269 C100,273.419 102.345,277.354 106,279.919 L106,287 L113.009,282.747 C113.979,282.907 114.977,283 116,283 C124.836,283 132,276.732 132,269 C132,261.269 124.836,255 116,255 L116,255 Z"
                                        id="comment-1"> </path>
                                </g>
                            </svg>
                        </span>
                        <span>
                            Мы в соцсетях:
                        </span>
                        <div class="social_networks">
                            @foreach ($user->socialNetworks as $social_network)
                                <a class="social_network" href="{{ $social_network->pivot->link }}" target="_blank">
                                    <div class="social_network_icon">
                                        {!! $social_network->icon !!}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </span>
                @endif
            </div>

        </div>
    </div>
    @include('publish.partials.scripts')
</body>

</html>
