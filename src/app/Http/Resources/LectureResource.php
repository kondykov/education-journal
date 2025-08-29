<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Lecture;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Lecture */
class LectureResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,

            'used_in' => $this->trainingPrograms,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
