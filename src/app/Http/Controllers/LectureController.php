<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\LectureResource;
use App\Interfaces\LectureServiceInterface;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LectureController extends Controller
{
    public function __construct(
        private readonly LectureServiceInterface $lectureService,
    )
    {
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => LectureResource::collection(Lecture::paginate())
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'unique:lectures', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        return response()->json([
            'success' => true,
            'data' => new LectureResource($this->lectureService->create($data))
        ], status: 201);
    }

    public function show(Lecture $lecture)
    {
        if ($lecture->exists()) {
            throw new NotFoundHttpException('Lecture not found');
        }

        return response()->json([
            'success' => true,
            'data' => new LectureResource($lecture)
        ]);
    }

    public function update(Request $request, Lecture $lecture)
    {
        if ($lecture->exists()) {
            throw new NotFoundHttpException('Lecture not found');
        }

        $data = $request->validate([
            'title' => [
                'required',
                Rule::unique('lectures')->ignore($lecture->id),
                'max:255',
                'string',
            ],
            'description' => ['required', 'string'],
        ]);

        return response()->json([
            'success' => true,
            'data' => new LectureResource($this->lectureService->update($data, $lecture))
        ]);
    }

    public function delete(Lecture $lecture)
    {
        $this->lectureService->remove($lecture);

        return response()->json(status: 204);
    }
}
