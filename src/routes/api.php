<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\TrainingProgramItemController;
use Illuminate\Support\Facades\Route;

route::prefix('lectures')->name('lectures.')->group(function () {
    route::get('/', [LectureController::class, 'index'])->name('index');
    route::post('/', [LectureController::class, 'store'])->name('store');
    route::put('/{lecture}', [LectureController::class, 'update'])->name('update');
    route::get('/{lecture}', [LectureController::class, 'show'])->name('show');
    route::delete('/{lecture}', [LectureController::class, 'delete'])->name('delete');
});

route::prefix('journal')->name('journal.')->group(function () {
    route::prefix('class')->group(function () {
    });

    route::prefix('programs')->name('programs.')->group(function () {
        route::get('/', [TrainingProgramController::class, 'index'])->name('index');
        route::post('/', [TrainingProgramController::class, 'store'])->name('store');
        route::get('/{program}', [TrainingProgramController::class, 'show'])->name('show');
        route::put('/{program}', [TrainingProgramController::class, 'update'])->name('update');
        route::delete('/{program}', [TrainingProgramController::class, 'delete'])->name('delete');

        route::prefix('items')->name('items.')->group(function () {
            route::post('/', [TrainingProgramItemController::class, 'add'])->name('add');
            route::delete('/', [TrainingProgramItemController::class, 'remove'])->name('remove');
        });
    });
});

