<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureWithListenedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->lecture->id,
            'title' => $this->lecture->title,
            'description' => $this->lecture->description,

            'listened' => $this->listened ? true : false,
            'listened_at' => $this->listened ? $this->listened->created_at : null,

            'created_at' => $this->lecture->created_at,
            'updated_at' => $this->lecture->updated_at,
        ];
    }
}
