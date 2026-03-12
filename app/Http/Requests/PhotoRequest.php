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
            'type'=>'required|in:landscapes,sun_and_moon,solar_system,deepsky,sat,misc',
            'title_ru'=>'required|string|max:255',
            'description_ru'=>'required|string',
            'title_by'=>'required|string|max:255',
            'description_by'=>'required|string',
            'title_en'=>'required|string|max:255',
            'description_en'=>'required|string',
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
