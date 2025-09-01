<?php

namespace App\Http\Resources;

use App\Models\LectureListened;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin LectureListened */
class LectureListenedResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,


            'lecture_id' => $this->lecture_id,
            'training_class_id' => $this->training_class_id,

            'lecture' => new LectureResource($this->whenLoaded('lecture')),
            'trainingClass' => new TrainingClassResource($this->whenLoaded('trainingClass')),
        ];
    }
}
