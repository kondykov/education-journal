<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Http\Requests\ExistsLectureRequest;
use App\Http\Resources\LectureResource;
use App\Interfaces\LectureServiceInterface;
use App\Models\Lecture;

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

    public function store(LectureRequest $request)
    {
        return response()->json([
            'success' => true,
            'data' => new LectureResource($this->lectureService->create($request->validated()))
        ], status: 201);
    }

    public function show(Lecture $lecture)
    {
        return response()->json([
            'success' => true,
            'data' => new LectureResource($lecture)
        ]);
    }

    public function update(ExistsLectureRequest $request, Lecture $lecture)
    {
        return response()->json([
            'success' => true,
            'data' => new LectureResource($this->lectureService->update($request->validated(), $lecture))
        ]);
    }

    public function delete(Lecture $lecture)
    {
        $this->lectureService->remove($lecture);

        return response()->json(status: 204);
    }
}
