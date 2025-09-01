<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lecture_listeneds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained('lectures');
            $table->foreignId('training_class_id')->constrained('training_classes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecture_listeneds');
    }
};
