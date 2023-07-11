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
            'exerciseable_id' => [
                'nullable',
            ],
            'exerciseable_type' => [
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

            // match validation
            'left1' => [
                'required_if:type,match',
                'string',
                'max:255',
            ],
            'right1' => [
                'required_if:type,match',
                'string',
                'max:255',
            ],
            'left2' => [
                'required_if:type,match',
                'string',
                'max:255',
            ],
            'right2' => [
                'required_if:type,match',
                'string',
                'max:255',
            ],
            'left3' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right3' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left4' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right4' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left5' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right5' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left6' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right6' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left7' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right7' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left8' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right8' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left9' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right9' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left10' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right10' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
