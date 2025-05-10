<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'workout_class_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workoutClass(): BelongsTo
    {
        return $this->belongsTo(WorkoutClass::class);
    }
}