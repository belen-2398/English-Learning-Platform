<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
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
            'content' => [
                'required',
                'string',
                'max:600'
            ],
            'exerciseable_id' => [
                'nullable'
            ],
            'exerciseable_type' => [
                'nullable',
            ],
        ];
    }
}
