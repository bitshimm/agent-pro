<?php

namespace App\Http\Requests\SpecialOffer;

use Illuminate\Foundation\Http\FormRequest;

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
			'title' => 'string|required',
			'content' => 'string|required',
			'image' => 'image|required',
			'sort' => 'integer',
			'visibility' => 'boolean'
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
			'sort.integer' => 'Сортировка должна иметь числовой формат',
		];
	}
}
