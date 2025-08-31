<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TrainingClassResource;
use App\Interfaces\TrainingClassServiceInterface;
use App\Models\TrainingClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'status' => true,
            'data' => TrainingClassResource::collection(TrainingClass::paginate()),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => [
                'required',
                Rule::unique('training_class', 'title')
            ],
            'training_program_id' => ['nullable', 'exists:training_programs'],
        ]);

        return response()->json([
            'status' => true,
            'data' => new TrainingClassResource($this->trainingClassService->create($data)),
        ], 201);
    }

    public function show(TrainingClass $trainingClass)
    {
        if (!$trainingClass->exists()) {
            throw new NotFoundHttpException('Training program not found');
        }

        return response()->json([
            'status' => true,
            'data' => new TrainingClassResource($trainingClass),
        ]);
    }

    public function update(Request $request, TrainingClass $trainingClass)
    {
        $data = $request->validate([
            'title' => [
                'required',
                Rule::unique('training_class', 'title')->ignore($trainingClass->id),
            ],
            'training_program_id' => ['nullable', 'exists:training_programs'],
        ]);

        if (!$trainingClass->exists()) {
            throw new NotFoundHttpException("Training class not found.");
        }

        $this->trainingClassService->update($trainingClass, $data);

        return response()->json([
            'status' => true,
            'data' => new TrainingClassResource($trainingClass),
        ]);
    }

    public function delete(TrainingClass $trainingClass)
    {
        $this->trainingClassService->delete($trainingClass->id);

        return response()->json(status: 204);
    }
}
