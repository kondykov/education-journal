<?php

namespace App\Providers;

use App\Interfaces\LectureServiceInterface;
use App\Interfaces\StudentServiceInterface;
use App\Interfaces\TrainingClassServiceInterface;
use App\Interfaces\TrainingProgramServiceInterface;
use App\Services\LectureService;
use App\Services\StudentService;
use App\Services\TrainingClassService;
use App\Services\TrainingProgramService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
        $this->app->bind(LectureServiceInterface::class, LectureService::class);
        $this->app->bind(TrainingClassServiceInterface::class, TrainingClassService::class);
        $this->app->bind(TrainingProgramServiceInterface::class, TrainingProgramService::class);
    }
}
