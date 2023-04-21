<x-app-layout>
    <x-slot name="header">
        <h2>
            Новости
        </h2>
    </x-slot>

    <h2>
        <a href="{{ route('articles.create') }}">Добавить</a>
    </h2>

    <table style="width: 100%;border-spacing:5px 1rem;">
        <thead style="font-weight: 700;">
            <tr>
                <td>ID</td>
                <td>Заголовок</td>
                <td>Изображение</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr style="border: 1px solid">
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td><a href="{{ $article->image }}" target="_blank">Ссылка</a></td>
                    <td><a href="{{ route('articles.edit', $article->id) }}">Редактировать</a></td>
                    <td>
                        <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
