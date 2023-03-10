@extends('layouts.example')

@section('content')
    @foreach ($images as $image)
    {{ $image->id }}
    @endforeach
@endsection
