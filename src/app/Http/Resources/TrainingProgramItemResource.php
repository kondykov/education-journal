<?php

namespace App\Http\Resources;

use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TrainingProgram */
class TrainingProgramItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->lecture_id,
        ];
    }
}
