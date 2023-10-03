<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DictionaryWordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'nullable'
            ],
            'word' => [
                'required',
                'string',
                'max:75'
            ],
            'notes' => [
                'nullable',
                'string',
                'max:800'
            ],
            'definition' => [
                'nullable',
                'string',
                'max:800'
            ],
            'pronunciation' => [
                'nullable',
                'string',
                'max:77'
            ],
            'example1' => [
                'nullable',
                'string',
                'max:600'
            ],
            'example2' => [
                'nullable',
                'string',
                'max:600'
            ],
            'example3' => [
                'nullable',
                'string',
                'max:600'
            ],
            'example4' => [
                'nullable',
                'string',
                'max:600'
            ],
            'example5' => [
                'nullable',
                'string',
                'max:600'
            ],
            'translation' => [
                'nullable',
                'string',
                'max:75'
            ],
        ];
    }
}
