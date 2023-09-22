<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordOfDayRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'word' => [
                'required',
                'string',
                'max:255'
            ],
            'type' => [
                'nullable',
                'string',
                'max:255'
            ],
            'pronunciation' => [
                'nullable',
                'string',
                'max:255'
            ],
            'audio' => [
                'nullable',
            ],
            'definition' => [
                'required',
                'string',
                'max:800'
            ],
            'example1' => [
                'required',
                'string',
                'max:250'
            ],
            'example2' => [
                'nullable',
                'string',
                'max:250'
            ],
            'example3' => [
                'nullable',
                'string',
                'max:250'
            ],
            'example4' => [
                'nullable',
                'string',
                'max:250'
            ],
            'example5' => [
                'nullable',
                'string',
                'max:250'
            ],
            'image' => [
                'nullable',
            ],
            'publish_date' => [
                'nullable',
            ],
        ];
    }
}
