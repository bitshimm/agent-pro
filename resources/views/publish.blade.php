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

</head>

<body class="body-background">
    @foreach ($user->socialNetworks as $social_network)
    <a href="{{ $social_network->pivot->link }}" target="_blank">
        {!! $social_network->icon !!}
    </a>
    @endforeach
</body>

</html>
