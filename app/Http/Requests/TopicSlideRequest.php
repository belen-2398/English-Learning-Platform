<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicSlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'topic_id' => [
                'required'
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
            'status' => [
                'nullable'
            ],
        ];
    }
}
