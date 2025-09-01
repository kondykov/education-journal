<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingClassController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\TrainingProgramItemController;
use Illuminate\Support\Facades\Route;

route::prefix('lectures')->name('lectures.')->group(function () {
    route::get('/', [LectureController::class, 'index'])->name('index');
    route::post('/', [LectureController::class, 'store'])->name('store');
    route::get('/{lecture}', [LectureController::class, 'show'])->name('show');
    route::put('/{lecture}', [LectureController::class, 'update'])->name('update');
    route::delete('/{lecture}', [LectureController::class, 'delete'])->name('delete');
});

route::prefix('journal')->name('journal.')->group(function () {
    route::prefix('class')->name('class.')->group(function () {
        route::get('/', [TrainingClassController::class, 'index'])->name('index');
        route::post('/', [TrainingClassController::class, 'store'])->name('store');
        route::get('/{trainingClass}', [TrainingClassController::class, 'show'])->name('show');
        route::put('/{trainingClass}', [TrainingClassController::class, 'update'])->name('update');
        route::post('/{trainingClass}', [TrainingClassController::class, 'listenLecture'])->name('listenLecture');
        route::get('/{trainingClass}', [TrainingClassController::class, 'getListened'])->name('getlistenLecture');
        route::delete('/{trainingClass}', [TrainingClassController::class, 'delete'])->name('delete');
    });

    route::prefix('students')->name('student.')->group(function () {
        route::get('/', [StudentController::class, 'index'])->name('index');
        route::post('/', [StudentController::class, 'store'])->name('store');
        route::get('/{student}', [StudentController::class, 'show'])->name('show');
        route::put('/{student}', [StudentController::class, 'update'])->name('update');
        route::delete('/{student}', [StudentController::class, 'delete'])->name('delete');
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

