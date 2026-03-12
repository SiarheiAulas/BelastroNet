<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check()&&auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug'=>'required|string|alpha_dash|max:50|unique:news,slug',
            'title_ru'=>'required|string|max:255',
            'text_ru'=>'required|string',
            'title_by'=>'required|string|max:255',
            'text_by'=>'required|string',
            'title_en'=>'required|string|max:255',
            'text_en'=>'required|string'
        ];
    }
}
