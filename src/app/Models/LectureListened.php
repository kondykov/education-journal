<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureListened extends Model
{
    protected $fillable = [
        'lecture_id',
        'training_class_id',
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function trainingClass()
    {
        return $this->belongsTo(TrainingClass::class);
    }
}
