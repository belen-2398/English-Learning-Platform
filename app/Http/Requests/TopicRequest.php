<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopicRequest extends FormRequest
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
        $ignoreRule = $this->method() === 'PUT' ? $this->topic->id : '';

        return [
            'lesson_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'category' => [
                'required',
                'in:grammar,vocabulary'
            ],
            'order' => [
                'nullable',
                'integer',
                Rule::unique('topics', 'order')->ignore($ignoreRule),
            ],
            'points' => [
                'required',
                'integer',
            ],
            'status' => [
                'nullable'
            ],
            'explanation1' => [
                'required',
                'string',
                'max:800'
            ],
            'explanation2' => [
                'nullable',
                'string',
                'max:800'
            ],
            'explanation3' => [
                'nullable',
                'string',
                'max:800'
            ],
            'explanation4' => [
                'nullable',
                'string',
                'max:800'
            ],
            'explanation5' => [
                'nullable',
                'string',
                'max:800'
            ],
        ];
    }
}
