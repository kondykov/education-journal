<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\StudentServiceInterface;
use App\Models\Student;

class StudentService implements StudentServiceInterface
{

    function create(array $data): Student
    {
        return Student::create($data);
    }

    function update(array $data, Student $student): Student
    {
        $student->update($data);
        return $student;
    }

    function delete(int $id): void
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }
}
