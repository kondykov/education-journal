<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TrainingProgramItemResource;
use App\Interfaces\TrainingProgramServiceInterface;
use App\Models\Lecture;
use App\Models\TrainingProgram;
use App\Models\TrainingProgramItem;
use Illuminate\Http\Request;

class TrainingProgramItemController extends Controller
{
    public function __construct(
        private TrainingProgramServiceInterface $trainingProgramService
    )
    {
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'training_program_id' => ['required', 'integer', 'exists:training_programs,id'],
            'lecture_id' => ['required', 'integer', 'exists:lectures,id'],
        ]);

        $this->trainingProgramService->addLecture($data['training_program_id'], $data['lecture_id']);

        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'training_program_id' => ['required', 'integer', 'exists:training_programs,id'],
            'lecture_id' => ['required', 'integer', 'exists:lectures,id'],
        ]);

        $this->trainingProgramService->removeLecture($data['training_program_id'], $data['lecture_id']);

        return response()->json(status: 204);
    }
}
