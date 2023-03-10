@extends('layouts.example')

@section('content')
    <div class="card_list">
        @foreach ($articles as $article)
            <div class="card_col">
                <div class="card_item">
                    <h2>{{ $article->id }}. {{ $article->title }}</h2>
                    <img src="{{ $article->image }}" alt="" style="display: block; width: 100%" loading="lazy">
                    <p>{{ $article->content }}</p>
                    <div style="display: flex; justify-content:space-between;">
                        <div>
                            <a href="{{ route('articles.edit', $article->id) }}" class="edit_btn">Изменить</a>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
