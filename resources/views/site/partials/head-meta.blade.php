<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

@if ($user->meta_title)
	<title>{{ $user->meta_title }}</title>
@endif
@if ($user->meta_description)
	<meta name="description" content="{{ $user->meta_description }}" />
@endif
