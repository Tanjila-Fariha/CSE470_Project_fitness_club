<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\WorkoutClass;
use App\Models\Notification;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, WorkoutClass $workoutClass)
    {
        // Validation and logic to store a class rating
        $rating = Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'workout_class_id' => $workoutClass->id],
            $request->only(['rating', 'comment'])
        );

        // Notify trainer about new rating
        Notification::create([
            'user_id' => $workoutClass->trainer->user_id,
            'type' => 'new_rating',
            'message' => "New {$rating->rating}-star rating received for {$workoutClass->type} class"
        ]);

        return back()->with('success', 'Rating submitted successfully!');
    }

    // ... methods for displaying ratings
}