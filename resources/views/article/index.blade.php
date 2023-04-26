<x-app-layout>
    <x-slot name="header">
        <h2>
            Новости
        </h2>
    </x-slot>

    <x-btn-create :href="route('articles.create')"/>

    <table>
        <thead>
            <tr>
                {{-- <td></td> --}}
                <th>ID</th>
                <th>Заголовок</th>
                <th>Изображение</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    {{-- <td><x-btn-edit :href="route('articles.edit', $article->id)"/>{{ $article->id }}</td> --}}
                    <td><x-btn-edit-id :href="route('articles.edit', $article->id)" :id="$article->id"/></td>
                    <td>{{ $article->title }}</td>
                    <td><a href="{{ $article->image }}" target="_blank">Ссылка</a></td>
                    <td><x-btn-destroy :action="route('articles.destroy', $article->id)"/></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
