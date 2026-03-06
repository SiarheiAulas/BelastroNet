<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type'=>'required|in:workshop,tricks,observations,recommendations,photo_and_video,astronews,misc',
            'title'=>'required|string|max:255',
            'slug'=>'required|string|alpha_dash|max:50|unique:articles,slug',
            'text'=>'required|string'
        ];
    }
}
