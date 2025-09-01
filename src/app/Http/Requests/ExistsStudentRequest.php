<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExistsStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $student = $this->route()->parameter('student');

        return [
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique('lectures', 'title')->ignore($student->id)
            ],
            'training_class_id' => ['nullable', 'exists:training_classes'],
        ];
    }
}
