<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Interfaces\StudentServiceInterface;
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StudentController extends Controller
{
    public function __construct(
        private StudentServiceInterface $studentService,
    )
    {
    }

    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => StudentResource::collection(Student::paginate()),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'training_class_id' => ['nullable', 'exists:training_classes'],
        ]);

        return response()->json([
            'status' => true,
            'data' => new StudentResource($this->studentService->create($data)),
        ]);
    }

    public function show(Student $student)
    {
        if (!$student->exists()) {
            throw new NotFoundHttpException('Student not found');
        }

        return response()->json([
            'status' => true,
            'data' => new StudentResource($student),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => ['required'],
            'training_class_id' => ['nullable', 'exists:training_classes'],
        ]);

        $this->studentService->update($data, $student);

        return response()->json([
            'status' => true,
            'data' => new StudentResource($student),
        ]);
    }

    public function delete(Student $student)
    {
        $this->studentService->delete($student->id);

        return response()->json(status: 204);
    }
}
