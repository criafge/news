<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNews extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заполните поле',
            'content.required' => 'Заполните поле',
            'category_id.required' => 'Заполните поле',
        ];
    }
}
