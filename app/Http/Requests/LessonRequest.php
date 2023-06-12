<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
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
        $ignoreRule = $this->method() === 'PUT' ? $this->lesson->id : '';

        return [
            'level' => [
                'required',
                'in:A1,A2,B1,B2,C1,C2'
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'required',
                'string',
                'max:800'
            ],
            'status' => [
                'nullable',
            ],
            'order' => [
                'required',
                'integer',
                Rule::unique('lessons', 'order')->ignore($ignoreRule),
            ]
        ];
    }
}
