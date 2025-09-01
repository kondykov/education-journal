<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExistsLectureRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $lecture = $this->route()->parameter('lecture');

        return [
            'title' => [
                'required',
                'string',
                Rule::unique('lectures', 'title')->ignore($lecture->id)
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
