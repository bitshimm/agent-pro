<x-app-layout>
    <x-slot name="header">
        <h2>
            Редактирование изображения
        </h2>
    </x-slot>
    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <img src="{{ $image->path_full }}" alt="{{ $image->alt }}" style="width: 25%;">
        </div>
        <div>
            <label for="image">image</label>
            <input type="file" name="image" id="image">
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
            <input type="submit" value="Сохранить">
        </div>
    </form>
</x-app-layout>
