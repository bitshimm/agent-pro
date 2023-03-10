@extends('layouts.example')

@section('content')
    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="image">image</label>
            <input type="file" name="image" id="image" required>
        </div>
        <div>
            <label for="caption">caption</label>
            <input type="text" name="caption" id="caption">
        </div>
        <div>
            <label for="alt">alt</label>
            <input type="text" name="alt" id="alt">
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
    <style>
        form {
            display: block;
            max-width: 1200px;
            margin: 0 auto;
        }

        div {
            margin-bottom: 2em;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif
        }

        input,
        textarea {
            box-sizing: border-box;
            width: 100%;
            padding: 10px 15px;
        }

        input[type=radio] {
            width: auto;
        }
    </style>
@endsection
