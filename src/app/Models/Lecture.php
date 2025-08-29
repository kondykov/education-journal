<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lectures';
    protected $fillable = [
        'title',
        'description',
    ];

    public function isInPrograms()
    {
        return $this->hasMany(TrainingProgramItem::class, 'lecture_id');
    }
}
