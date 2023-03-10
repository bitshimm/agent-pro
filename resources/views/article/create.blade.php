@extends('layouts.example')

@section('content')
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="content">content</label>
            <textarea name="content" id="" rows="10" id="content" required></textarea>
        </div>
        <div>
            <label for="image">image</label>
            <input type="text" name="image" id="image">
        </div>
        <div>
            <label for="sort">sort</label>
            <input type="number" name="sort" id="sort" value="100">
        </div>
        <div>
            <label for="visibility-true">Включить</label>
            <input type="radio" name="visibility" id="visibility-true" value="1" checked>
            <label for="visibility-false">Выключить</label>
            <input type="radio" name="visibility" id="visibility-false" value="0">
        </div>
        <div>
            <input type="submit" value="Добавить">
        </div>
    </form>
@endsection
