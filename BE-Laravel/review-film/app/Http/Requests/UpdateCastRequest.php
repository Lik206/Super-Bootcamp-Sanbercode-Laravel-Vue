<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCastRequest extends FormRequest
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
            'name' => 'string|max:255',
            'bio' => 'string',
            'age' => 'integer'
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'name tidak boleh lebih dari 255 karakter',
            'age.integer' => 'age harus diisi dengan angka'
        ];
    }
}
