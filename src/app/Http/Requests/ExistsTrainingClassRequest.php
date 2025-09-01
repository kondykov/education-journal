<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExistsTrainingClassRequest extends FormRequest
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
        $trainingClass = $this->route()->parameter('trainingClass');

        return [
            'title' => [
                'required',
                Rule::unique('training_class', 'title')->ignore($trainingClass->id),
            ],
            'training_program_id' => ['nullable', 'exists:training_programs'],
        ];
    }
}
