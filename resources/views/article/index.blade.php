<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <ul>
            <li><a href="{{ route('articles.index') }}">Все Статьи</a></li>
            <li><a href="{{ route('articles.create') }}">Создать Статью</a></li>
            {{-- <li><a href="{{ route('articles.edit') }}"></a></li> --}}
        </ul>
        <div class="card_list">
            @foreach ($articles as $article)
                <div class="card_col">
                    <div class="card_item">
                        <h2>{{ $article->id }}. {{ $article->title }}</h2>
                        <img src="{{ $article->image }}" alt="" style="display: block; width: 100%"
                            loading="lazy">
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
    </div>

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 7.5px;
        }

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

        /* @media(max-width: 992px) {
            .card_list {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width: 768px) {
            .card_list {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 576px) {
            .card_list {
                grid-template-columns: repeat(1, 1fr);
            }
        } */

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
</body>

</html>
