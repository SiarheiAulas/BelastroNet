<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
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
            'title_ru'=>'required|string|max:255',
            'description_ru'=>'required|string',
            'title_by'=>'required|string|max:255',
            'description_by'=>'required|string',
            'title_en'=>'required|string|max:255',
            'description_en'=>'required|string',
            'file'=> [
                Rule::requiredIf($this->isMethod('POST')),
                'file',
                'extensions:pdf,txt,doc,docx,xls,xlsx,ppt,pptx,djvu',
                'mimes:pdf,txt,doc,docx,xls,xlsx,ppt,pptx,djvu',
                'max:10240'
            ]
        ];
    }
}
