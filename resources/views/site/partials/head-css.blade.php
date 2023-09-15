<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/brands.min.css">
<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/regular.min.css">
<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/solid.min.css">
<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="{{ $host }}/css/fancybox/fancybox.min.css" />
<link rel="stylesheet" href="{{ $host }}/css/swiper/swiper-10.1.0.min.css" />

<link rel="stylesheet" href="{{ $host }}/siteStatic/style.css?{{ config('version.hash') }}">

<style>
    :root {
        @if ($themeProperties)
            @foreach ($themeProperties as $property)
                @if ($property['value'])
                    {{ $property['slug'] }}: {{ $property['value'] }};
                @endif
            @endforeach
        @endif
    }

    body {
        background-image: url('{{ $theme->background }}');
    }
</style>
