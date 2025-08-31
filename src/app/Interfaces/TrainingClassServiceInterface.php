<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\TrainingClass;

interface TrainingClassServiceInterface
{
    function create(array $data): TrainingClass;
    function update(TrainingClass $trainingClass, array $data): TrainingClass;
    function delete(int $id): void;
    function enroll(int $id, int $studentId): TrainingClass;
    function deduct(int $id, int $studentId): TrainingClass;
}
