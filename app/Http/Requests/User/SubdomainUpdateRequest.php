<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class SubdomainUpdateRequest extends FormRequest
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
		/**
		 * [a-z\d]+ (первый символ буква или цифра  один или более)
		 * [a-z\d-]+ (буква/цифоа/дефис один или более) 
		 */
		return [
			'subdomain' => ['regex:/^[a-z\d]{1,63}(-[a-z\d]{1,63})*$/'],
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array<string, string>
	 */
	public function messages(): array
	{
		return [
			'subdomain.regex' => 'Поддомен должен содержать от 1 до 63 символов (латинских букв, цифр, дефисов).',
		];
	}
}
