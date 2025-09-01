<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExistsStudentRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Interfaces\StudentServiceInterface;
use App\Models\Student;

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
            'success' => true,
            'data' => StudentResource::collection(Student::paginate()),
        ]);
    }

    public function store(StudentRequest $request)
    {
        return response()->json([
            'success' => true,
            'data' => new StudentResource($this->studentService->create($request->validated())),
        ]);
    }

    public function show(Student $student)
    {
        return response()->json([
            'success' => true,
            'data' => new StudentResource($student),
        ]);
    }

    public function update(ExistsStudentRequest $request, Student $student)
    {
        $this->studentService->update($request->validated(), $student);

        return response()->json([
            'success' => true,
            'data' => new StudentResource($student),
        ]);
    }

    public function delete(Student $student)
    {
        $this->studentService->delete($student->id);

        return response()->json(status: 204);
    }
}
