<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/brands.min.css">
<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/regular.min.css">
<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/solid.min.css">
<link rel="stylesheet" href="{{ $host }}/css/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="{{ $host }}/css/fancybox/fancybox.min.css" />
<link rel="stylesheet" href="{{ $host }}/css/glide/glide.core.min.css" />

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

    @if ($theme && $theme->background)
        .wrapper {
            background-image: url('{{ $theme->background }}');
        }
    @endif
</style>
