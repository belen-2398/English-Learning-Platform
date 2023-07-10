<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
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
            'lesson_id' => [
                'nullable',
            ],
            'topic_id' => [
                'nullable',
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'level'  => [
                'required',
                'in:A1,A2,B1,B2,C1,C2'
            ],
            'category'  => [
                'required',
                'in:grammar,vocabulary,mixed'
            ],
            'order' => [
                'required',
                'integer',
            ],
            'type'  => [
                'required',
                'in:match,fill,order,select'
            ],
            'status'  => [
                'nullable',
            ],
        ];
    }
}
