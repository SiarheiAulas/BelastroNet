<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'file'=> [
                Rule::requiredIf($this->isMethod('POST')),
                'file',
                'extensions:jpg,jpeg,png,gif,tiff,raw,bmp,svg,webp,heic,fits',
                'mimes:jpg,jpeg,png,gif,tiff,raw,bmp,svg,webp,heic,fits',
                'max:51200'
            ]
        ];
    }
}
