<x-app-layout>
    <x-slot name="header">
        <h2>
            Изображения
        </h2>
    </x-slot>

    <h2>
        <a href="{{ route('images.create') }}">Добавить</a>
    </h2>
    <div>
        @foreach ($images as $image)
            <div>
                <a href="">
                    <img src="{{ $image->path_full }}" alt="" style="width:100%;">
                    {{-- <div class="on_hover_image">{{ $image->id }}. {{ $image->caption }}</div> --}}
                </a>
                <a href="{{ route('images.edit', $image->id) }}" class="edit_btn">Изменить</a>
                <form method="POST" action="{{ route('images.destroy', $image->id) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Удалить" class="remove_btn">
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
