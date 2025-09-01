<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExistsTrainingClassRequest;
use App\Http\Requests\TrainingClassRequest;
use App\Http\Resources\TrainingClassResource;
use App\Interfaces\TrainingClassServiceInterface;
use App\Models\TrainingClass;

class TrainingClassController extends Controller
{
    public function __construct(
        private TrainingClassServiceInterface $trainingClassService,
    )
    {
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => TrainingClassResource::collection(TrainingClass::paginate()),
        ]);
    }

    public function store(TrainingClassRequest $request)
    {
        return response()->json([
            'success' => true,
            'data' => new TrainingClassResource($this->trainingClassService->create($request->validated())),
        ], 201);
    }

    public function show(TrainingClass $trainingClass)
    {
        return response()->json([
            'success' => true,
            'data' => new TrainingClassResource($trainingClass),
        ]);
    }

    public function update(ExistsTrainingClassRequest $request, TrainingClass $trainingClass)
    {
        $this->trainingClassService->update($trainingClass, $request->validated());

        return response()->json([
            'success' => true,
            'data' => new TrainingClassResource($trainingClass),
        ]);
    }

    public function delete(TrainingClass $trainingClass)
    {
        $this->trainingClassService->delete($trainingClass->id);

        return response()->json(status: 204);
    }
}
