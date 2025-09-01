<?php

namespace App\Http\Resources;

use App\Models\TrainingClass;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TrainingClass */
class TrainingClassResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'training_program_id' => $this->training_program_id,

            'trainingProgram' => new TrainingProgramResource($this->whenLoaded('trainingProgram')),
        ];
    }
}
