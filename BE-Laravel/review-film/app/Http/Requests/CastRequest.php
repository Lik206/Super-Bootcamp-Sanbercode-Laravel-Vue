<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CastRequest extends FormRequest
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
            'name' => 'required|max:255',
            'bio' => 'required',
            'age' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name harus diisi',
            'name.max' => 'name tidak boleh lebih dari 255 karakter',
            'bio.required' => 'bio harus diisi',
            'age.required' => 'age harus diisi',
            'age.integer' => 'age harus diisi dengan angka'
        ];
    }
}
