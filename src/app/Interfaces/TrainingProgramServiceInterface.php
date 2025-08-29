<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\TrainingProgram;

interface TrainingProgramServiceInterface
{
    function create(array $data): TrainingProgram;
    function update(array $data, TrainingProgram $program): TrainingProgram;
    function delete(TrainingProgram $program): void;
    function addLecture(int $programId, int $lectureId): void;
    function removeLecture(int $programId, int $lectureId): void;
}
