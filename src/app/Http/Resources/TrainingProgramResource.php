<?php

namespace App\Http\Resources;

use App\Models\TrainingProgram;
use App\Models\TrainingProgramItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TrainingProgram */
class TrainingProgramResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,

            'lectures' => TrainingProgramItemResource::collection($this->lectures),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
