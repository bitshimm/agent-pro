<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp,gif',
            'caption' => 'string|nullable',
            'alt' => 'string|nullable',
            'sort' => 'integer',
            'visibility' => 'boolean'
        ];
    }
}
