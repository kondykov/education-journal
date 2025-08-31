<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\TrainingClassServiceInterface;
use App\Models\TrainingClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TrainingClassService implements TrainingClassServiceInterface
{

    function create(array $data): TrainingClass
    {
        return TrainingClass::create($data);
    }

    function update(TrainingClass $trainingClass, array $data): TrainingClass
    {
        $trainingClass->update($data);
        return $trainingClass;
    }

    function delete(int $id): void
    {
        $class = TrainingClass::findOrFail($id);
        $class->delete();
    }

    function enroll(int $id, int $studentId): TrainingClass
    {
        $class = TrainingClass::findOrFail($id);
        $class->students()->attach($studentId);

        $class->save();

        return $class;
    }

    function deduct(int $id, int $studentId): TrainingClass
    {
        $class = TrainingClass::findOrFail($id);
        $class->students()->detach($studentId);

        $class->save();

        return $class;
    }
}
