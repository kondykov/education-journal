<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\LectureResource;
use App\Interfaces\LectureServiceInterface;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LectureController extends Controller
{
    public function __construct(
        private readonly LectureServiceInterface $lectureService,
    )
    {
    }

    public function index()
    {
        return LectureResource::collection(Lecture::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:lectures', 'max:255'],
            'description' => ['required'],
        ]);

        return new LectureResource($this->lectureService->create($data));
    }

    public function show(Lecture $lecture)
    {
        return new LectureResource($lecture);
    }

    public function update(Request $request, Lecture $lecture)
    {
        $data = $request->validate([
            'title' => [
                'required',
                Rule::unique('lectures')->ignore($lecture->id),
                'max:255',
            ],
            'description' => ['required'],
        ]);

        return new LectureResource($this->lectureService->update($data, $lecture));
    }

    public function delete(Lecture $lecture)
    {
        $this->lectureService->remove($lecture);

        return response()->json(status: 204);
    }
}
