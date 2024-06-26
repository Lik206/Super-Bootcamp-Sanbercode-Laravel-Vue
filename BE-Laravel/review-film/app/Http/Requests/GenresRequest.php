<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenresRequest extends FormRequest
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
            'name' => 'required|max:255|unique:genres,name',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'name harus diisi',
            'name.max' => 'name tidak boleh lebih dari 255 karakter',
            'name.unique' => 'nama genresudah terdaftar'
        ];
    }
}
