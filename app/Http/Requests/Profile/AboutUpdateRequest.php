<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class AboutUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'about_title' => ['string', 'max:255', 'nullable'],
            'about_short_description' => ['string', 'nullable'],
            'about_full_description' => ['string', 'nullable'],
        ];
    }
}
