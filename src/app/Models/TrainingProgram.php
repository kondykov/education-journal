<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingProgram extends Model
{
    protected $fillable = [
        'title',
    ];

    public function items()
    {
        return $this->hasMany(TrainingProgramItem::class, 'training_program_id');
    }
}
