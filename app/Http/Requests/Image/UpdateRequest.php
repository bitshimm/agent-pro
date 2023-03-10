<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'image' => 'image',
            'caption' => 'string|nullable',
            'alt' => 'string|nullable',
            'sort' => 'integer',
            'visibility' => 'boolean'
        ];
    }
}
