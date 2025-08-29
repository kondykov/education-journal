<?php

use App\Http\Controllers\LectureController;
use Illuminate\Support\Facades\Route;

route::prefix('lectures')->group(function () {
    route::get('/', [LectureController::class, 'index'])->name('lectures.index');
    route::post('/', [LectureController::class, 'store'])->name('lectures.store');
    route::get('/{lecture}', [LectureController::class, 'show'])->name('lectures.show');
    route::delete('/{lecture}', [LectureController::class, 'delete'])->name('lectures.delete');
});

route::prefix('journal')->group(function () {
    route::prefix('class')->group(function () {
    });

    route::prefix('programs')->group(function () {
    });
});

