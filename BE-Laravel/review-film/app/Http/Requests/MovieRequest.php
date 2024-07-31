<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
        'title' => 'required|max:255',
            'summary' => 'required',
            'poster' => 'mimes:jpg,jpeg,png',
            'genre_id' => 'required',
            'year' => 'required|min:4|max:4|not_in:0'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'title harus diisi',
            'title.max' => 'title maksimal 255 karakter',
            'summary.required' => 'summary harus diisi',
            'year.required' => 'year harus diisi',
            'year.min' => 'year bukan dari tahun atau kurang dari 4 angka',
            'year.max' => 'year bukan dari tahun atau melebihi 4 angka',
            'poster.mimes' => 'poster hanya boleh diisi dengan format jpg,bmp,png',
            'genre_id.required' => 'genre_id harus diisi'
        ];
    }
}
