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
                            <a href="{{ route('articles.edit', $article->id) }}" class="record_show">Изменить</a>
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
    <style>
        .card_list {
            /* display: grid;
                gap: 10px;
                grid-template-columns: repeat(4, 1fr);
                font-size: 14px;
                font-weight: 500; */
            display: flex;
            flex-wrap: wrap;
            margin: -7.5px;
        }


        .card_col {
            flex: 0 0 100%;
            padding: 7.5px;
            box-sizing: border-box;
        }

        @media(min-width: 576px) {
            .card_col {
                flex: 0 0 50%;
                /* max-width: 50%; */
            }
        }

        @media(min-width: 992px) {
            .card_col {
                flex: 0 0 calc(100% / 3);
                /* max-width: calc(100%  / 3); */
            }
        }

        @media(min-width: 1200px) {
            .card_col {
                flex: 0 0 25%;
                /* max-width: 25%; */
            }
        }

        .record_show {
            display: block;
            background: lightblue;
            color: #000;
            padding: 10px 15px;
            text-decoration: none;
        }

        input[type="submit"] {
            display: block;
            background: red;
            color: #fff;
            border: none;
            padding: 10px 15px;
        }
    </style>
@endsection
