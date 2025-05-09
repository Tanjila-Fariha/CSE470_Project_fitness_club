<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\WorkoutClass;


class EnrollmentController extends Controller
{
    public function enroll(WorkoutClass $workoutClass)
    {
        // Logic to enroll a user in a class
        if ($workoutClass->enrollments()->count() < $workoutClass->capacity) {
            Enrollment::create(['user_id' => auth()->id(), 'workout_class_id' => $workoutClass->id]);
            // Optionally send notifications
            return back()->with('success', 'Successfully enrolled!');
        } else {
            return back()->with('error', 'Class is full!');
        }
    }

    public function unenroll(WorkoutClass $workoutClass)
    {
        // Logic to unenroll a user from a class
        Enrollment::where('user_id', auth()->id())->where('workout_class_id', $workoutClass->id)->delete();
        return back()->with('success', 'Successfully unenrolled!');
    }

    // ... other methods for managing enrollments
}