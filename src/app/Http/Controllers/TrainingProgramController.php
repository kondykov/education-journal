<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrainingProgramResource;
use App\Interfaces\TrainingProgramServiceInterface;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required|string'],
        ]);

        return response()->jspn([
            'status' => true,
            'data' => new TrainingProgramResource(TrainingProgram::create($data)),
        ]);
    }

    public function show(TrainingProgram $trainingProgram)
    {
        if ($trainingProgram->exists()) {
            throw new NotFoundHttpException('Training program not found');
        }

        return response()->json([
            'status' => true,
            'data' => new TrainingProgramResource($trainingProgram),
        ]);
    }

    public function update(Request $request, TrainingProgram $trainingProgram)
    {
        $data = $request->validate([
            'title' => ['required|string'],
        ]);

        if ($trainingProgram->exists()) {
            throw new NotFoundHttpException('Training program not found');
        }

        $this->trainingProgramService->update($data, $trainingProgram);

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
