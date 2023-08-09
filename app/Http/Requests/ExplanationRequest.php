<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExplanationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'topic_slide_id' => [
                'nullable',
            ],
            'explanation'  => [
                'required',
                'max:2000'
            ],
        ];
    }
}
