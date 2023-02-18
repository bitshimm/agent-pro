<form action="{{ route('articles.update', $article->id) }}" method="POST">
    <a class="list_show" href="{{ route('articles.index') }}">Назад</a>
    @csrf
    @method('patch')
    <div>
        <label for="title">title</label>
        <input type="text" name="title" id="title" value="{{ $article->title }}" required>
    </div>
    <div>
        <label for="content">content</label>
        <textarea name="content" id="" rows="10" id="content" required>{{ $article->content }}</textarea>
    </div>
    <div>
        <label for="image">image</label>
        <input type="text" name="image" id="image" value="{{ $article->image }}">
    </div>
    <div>
        <label for="sort">sort</label>
        <input type="number" name="sort" id="sort" value="{{ $article->sort }}">
    </div>
    <div>
        <label for="visibility-true">Включить</label>
        <input type="radio" name="visibility" id="visibility-true" value="1"
            {{ $article->visibility ? 'checked' : '' }}>
        <label for="visibility-false">Выключить</label>
        <input type="radio" name="visibility" id="visibility-false" value="0"
            {{ !$article->visibility ? 'checked' : '' }}>
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

    .list_show {
        display: block;
        background: lightblue;
        color: #000;
        padding: 10px 15px;
        text-decoration: none;
        margin-bottom: 2em;
    }
</style>
