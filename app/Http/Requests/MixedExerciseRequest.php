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

    public function rules(): array
    {
        return [
            'lesson_id' => [
                'nullable',
            ],
            'mxexerciseable_id' => [
                'nullable',
            ],
            'mxexerciseable_type' => [
                'nullable',
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'prompt' => [
                'nullable',
                'string',
                'max:600'
            ],
            'order' => [
                'required',
                'integer',
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
                'nullable',
                'string',
                'max:255',
            ],
            'right1' => [
                'nullable',
                'string',
                'max:255',
            ],
            'left2' => [
                'nullable',
                'string',
                'max:255',
            ],
            'right2' => [
                'nullable',
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

            // fill validation
            'fillText' => [
                'nullable',
                'string',
                'max:4000',
            ],
            'words_to_fill' => [
                'nullable',
                'string',
                'max:255',
            ],

            // order validation
            'orSentence1' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence2' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence3' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence4' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence5' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence6' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence7' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence8' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence9' => [
                'nullable',
                'string',
                'max:400',
            ],
            'orSentence10' => [
                'nullable',
                'string',
                'max:400',
            ],

            // select validation
            'selectText' => [
                'nullable',
                'string',
                'max:4000',
            ],
            'selectAnswers' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}
