<?php

namespace App\Services;

use App\Interfaces\LectureServiceInterface;
use App\Models\Lecture;

class LectureService implements LectureServiceInterface
{
    function create(array $data): Lecture
    {
        return Lecture::create($data);
    }

    function update(array $data, Lecture $lecture): Lecture
    {
        $lecture->update($data);
        return $lecture;
    }

    function remove(Lecture $lecture): bool
    {
        $lecture->delete();

        return true;
    }
}
