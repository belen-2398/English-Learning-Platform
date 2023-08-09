<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MixedExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // TODO: update with exercise types
    public function rules(): array
    {
        $ignoreRule = $this->method() === 'PUT' ? $this->mixedExercise->id : '';

        return [
            'lesson_id' => [
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
            'order' => [
                'required',
                'integer',
                Rule::unique('mixed_exercises', 'order')->ignore($ignoreRule),
            ],
            'lesson_id' => [
                'nullable',
            ],
            'type'  => [
                'required',
                'in:match,fill,order,select'
            ],
            'status' => [
                'nullable'
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
