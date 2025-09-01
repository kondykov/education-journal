<?php
declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\LectureWithListenedData;
use App\Exceptions\EntityExistsExceptions;
use App\Http\Requests\LectureRequest;
use App\Interfaces\TrainingClassServiceInterface;
use App\Models\Lecture;
use App\Models\LectureListened;
use App\Models\TrainingClass;
use App\Models\TrainingProgram;
use App\Models\TrainingProgramItem;
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

    function listenLecture(TrainingClass $trainingClass, int $lectureId): void
    {
        $program = $trainingClass->trainingProgram()->firstOrFail();

        foreach ($program->lectures as $lecture) {
            if ($lecture->id === $lectureId) {
                break;
            }
            throw new NotFoundHttpException('Lecture is not in training program');
        }

        if (LectureListened::where('training_class_id', $trainingClass->id)->where('lecture_id', $lectureId)->exists()) {
            throw new EntityExistsExceptions('Lecture already listened');
        }

        LectureListened::create([
            'training_class_id' => $trainingClass->id,
            'lecture_id' => $lectureId,
        ]);
    }

    function getLecturesInSelectedProgram(TrainingClass $trainingClass): array
    {
        $program = $trainingClass->trainingProgram()
            ->with(['items.lecture'])
            ->firstOrFail();

        $allLectures = $program->items
            ->map(function ($item) {
                return $item->lecture;
            })
            ->filter()
            ->unique('id')
            ->values();

        $listenedLectures = LectureListened::where('training_class_id', $trainingClass->id)
            ->get()
            ->keyBy('lecture_id');

        $combinedLectures = $allLectures->map(function ($lecture) use ($listenedLectures, $trainingClass) {
            $listened = $listenedLectures->get($lecture->id);

            return new LectureWithListenedData($lecture, $listened);
        });

        return $combinedLectures->toArray();
    }
}
