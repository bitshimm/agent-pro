@extends('layouts.example')

@section('content')
    <div class="card_list">
        @foreach ($images as $image)
            <div class="card_col">
                <div class="card_item">
                    <h2>{{ $image->id }}. {{ $image->caption }}</h2>
                    <img src="{{ $image->path_full }}" alt="" style="display: block; width: 100%" loading="lazy">
                    <div style="display: flex; justify-content:space-between;">
                        <div>
                            <a href="{{ route('images.edit', $image->id) }}" class="edit_btn">Изменить</a>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('images.destroy', $image->id) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить" class="remove_btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
