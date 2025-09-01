<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TrainingProgramItemRequest;
use App\Interfaces\TrainingProgramServiceInterface;

class TrainingProgramItemController extends Controller
{
    public function __construct(
        private TrainingProgramServiceInterface $trainingProgramService
    )
    {
    }

    public function add(TrainingProgramItemRequest $request)
    {
        $data = $request->validated();

        $this->trainingProgramService->addLecture($data['training_program_id'], $data['lecture_id']);

        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    public function remove(TrainingProgramItemRequest $request)
    {
        $data = $request->validated();

        $this->trainingProgramService->removeLecture($data['training_program_id'], $data['lecture_id']);

        return response()->json(status: 204);
    }
}
