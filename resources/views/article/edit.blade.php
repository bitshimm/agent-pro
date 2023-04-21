<x-app-layout>
    <x-slot name="header">
        <h2>
            Редактирование новости
        </h2>
    </x-slot>
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
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
            <input type="submit" value="Сохранить">
        </div>
    </form>
</x-app-layout>
