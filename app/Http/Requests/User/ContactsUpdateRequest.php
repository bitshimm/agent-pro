<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ContactsUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'contact_phone' => ['string', 'max:255', 'nullable'],
			'contact_phone_second' => ['string', 'max:255', 'nullable'],
			'contact_email' => ['email', 'max:255', 'nullable'],
			'contact_address' => ['string', 'max:255', 'nullable'],
			'contact_opening_hours' => ['string', 'max:255', 'nullable'],
        ];
    }
}
