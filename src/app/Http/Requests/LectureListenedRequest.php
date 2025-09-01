<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureListenedRequest extends FormRequest
{
    public function rules()
    {
        return [
            'lecture_id' => ['required', 'exists:lectures'],
            'training_class_id' => ['required', 'exists:training_classes'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
