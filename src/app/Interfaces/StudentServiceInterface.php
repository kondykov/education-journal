<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Student;

interface StudentServiceInterface
{
    function create(array $data): Student;
    function update(array $data, Student $student): Student;
    function delete(int $id): void;
}
