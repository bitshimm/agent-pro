<x-app-layout>
    <x-slot name="header">
        <h2>
            Изображения
        </h2>
    </x-slot>

    <x-btn-create :href="route('images.create')"/>

    <div>
        @foreach ($images as $image)
            <div>
                <a href="">
                    <img src="{{ $image->path_full }}" alt="" style="width:100%;">
                    {{-- <div class="on_hover_image">{{ $image->id }}. {{ $image->caption }}</div> --}}
                </a>
                <a href="{{ route('images.edit', $image->id) }}" class="btn_edit">Изменить</a>
                <form method="POST" action="{{ route('images.destroy', $image->id) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Удалить" class="remove_btn">
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
