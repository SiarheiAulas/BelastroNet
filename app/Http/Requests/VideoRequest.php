<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoRequest extends FormRequest
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
            'type'=>'required|in:landscapes,sun_and_moon,solar_system,events,misc',
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'file'=>[
                    Rule::requiredIf($this->isMethod('POST')),
                    'file',
                    'extensions:mp4,mov,avi,mkv,webm,mpeg',
                    'mimes:mp4,mov,avi,mkv,webm,mpeg',
                    'max:51200'
                ]
        ];
    }
}
