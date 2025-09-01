<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingProgramRequest;
use App\Http\Resources\TrainingProgramResource;
use App\Interfaces\TrainingProgramServiceInterface;
use App\Models\TrainingProgram;

class TrainingProgramController extends Controller
{
    public function __construct(
        private TrainingProgramServiceInterface $trainingProgramService,
    )
    {
    }

    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => TrainingProgramResource::collection(TrainingProgram::all()),
        ]);
    }

    public function store(TrainingProgramRequest $request)
    {
        return response()->json([
            'status' => true,
            'data' => new TrainingProgramResource($this->trainingProgramService->create($request->validated())),
        ]);
    }

    public function show(TrainingProgram $trainingProgram)
    {
        return response()->json([
            'status' => true,
            'data' => new TrainingProgramResource($trainingProgram),
        ]);
    }

    public function update(TrainingProgramRequest $request, TrainingProgram $trainingProgram)
    {
        $this->trainingProgramService->update($request->validated(), $trainingProgram);

        return response()->json([
            'status' => true,
            'data' => new TrainingProgramResource($trainingProgram),
        ]);
    }

    public function delete(TrainingProgram $trainingProgram)
    {
        $this->trainingProgramService->delete($trainingProgram);

        return response()->json(status: 204);
    }
}
