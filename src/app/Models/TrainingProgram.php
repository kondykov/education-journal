<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingProgram extends Model
{
    protected $fillable = [
        'title',
    ];

    public function lectures()
    {
        return $this->hasMany(TrainingProgramItem::class, 'training_program_id');
    }
}
