<ul class="navigation">
    <li><a href="{{ route('articles.index') }}">Articles</a>
        {{-- <ul class="dropdown">
            <li><a href="{{ route('articles.create') }}">Добавить Статью</a></li>
        </ul> --}}
    </li>
    <li><a href="{{ route('articles.create') }}">Добавить Статью</a></li>
    <li><a href="{{ route('images.index') }}">Images</a></li>
    <li><a href="{{ route('images.create') }}">Добавить изображение</a></li>
    <li style="margin-left: auto;"><a href="{{ url()->previous() }}">Назад</a></li>
</ul>
<style>
    .navigation {
        display: flex;
        /* margin: 0 -10px; */
        margin-bottom: 10px;
        padding: 15px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.3);
        /* position: fixed;
        width: 100%;
        background: #fff; */
    }

    .navigation li {
        list-style-type: none;
        margin: 0 10px;
        padding: 5px 10px;
        position: relative;
    }

    .navigation li a {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        text-decoration: none;
    }

    .navigation .dropdown {
        position: absolute;
        background: #cccccc;
        left: 0;
        top: 40px;
        display: none;
    }

    .navigation li a:hover {
        color: #4e4e4e;
    }
    /* .navigation > li a:hover + .dropdown {
        display: block;
    } */
</style>
