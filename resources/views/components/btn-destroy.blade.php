<form method="POST" class="btn_destroy" {{ $attributes }}>
    @csrf
    @method('delete')
    <button type="submit">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
