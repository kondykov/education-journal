<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Lecture;

interface LectureServiceInterface
{
    function create(array $data): Lecture;

    function update(array $data, Lecture $lecture): Lecture;

    function remove(Lecture $lecture): bool;
}
