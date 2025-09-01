<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\EntityExistsExceptions;
use App\Interfaces\TrainingProgramServiceInterface;
use App\Models\TrainingProgram;
use App\Models\TrainingProgramItem;

class TrainingProgramService implements TrainingProgramServiceInterface
{

    function create(array $data): TrainingProgram
    {
        return TrainingProgram::create([
            'title' => $data['title'],
        ]);
    }

    function update(array $data, TrainingProgram $program): TrainingProgram
    {
        $program->update($data);
        return $program;
    }

    function delete(TrainingProgram $program): void
    {
        $program->delete();
    }

    /**
     * @throws EntityExistsExceptions
     */
    function addLecture(int $programId, int $lectureId): void
    {
        if (TrainingProgramItem::where('training_program_id', $programId)->where('lecture_id', $lectureId)->exists()) {
            throw new EntityExistsExceptions('Lecture already added in this program');
        }

        TrainingProgramItem::create(['lecture_id' => $lectureId, 'training_program_id' => $programId]);
    }

    function removeLecture(int $programId, int $lectureId): void
    {
        $item = TrainingProgramItem::where('program_id', $programId)->where('lecture_id', $lectureId)->firstOrFail();
        $item->delete();
    }
}
