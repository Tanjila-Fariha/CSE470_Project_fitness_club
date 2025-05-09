<?php

namespace App\Http\Controllers;

use App\Models\WorkoutClass;
use App\Models\Enrollment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserClassController extends Controller
{
    public function index()
    {
        $classes = WorkoutClass::withCount('enrollments')
            ->with(['ratings' => function($query) {
                $query->with('user')->latest();
            }])
            ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->get();

        $enrolledClasses = Auth::user()
            ->enrollments()
            ->with(['workoutClass' => function($query) {
                $query->with(['ratings' => function($query) {
                    $query->where('user_id', Auth::id());
                }]);
            }])
            ->get()
            ->pluck('workoutClass');

        return view('user_home', compact('classes', 'enrolledClasses'));
    }

    public function enroll(WorkoutClass $class)
    {
        // Check if user is already enrolled
        if ($class->enrollments()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You are already enrolled in this class.');
        }

        // Check if class is full
        if ($class->enrollments()->count() >= $class->capacity) {
            return back()->with('error', 'Sorry, this class is full.');
        }

        // Create enrollment
        Enrollment::create([
            'user_id' => Auth::id(),
            'workout_class_id' => $class->id
        ]);

        return back()->with('success', 'Successfully enrolled in the class!');
    }

    public function unenroll(WorkoutClass $class)
    {
        $enrollment = $class->enrollments()
            ->where('user_id', Auth::id())
            ->first();

        if ($enrollment) {
            $enrollment->delete();
            return back()->with('success', 'Successfully unenrolled from the class.');
        }

        return back()->with('error', 'You are not enrolled in this class.');
    }

    public function rate(Request $request, WorkoutClass $class)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        // Check if user is enrolled in the class
        if (!$class->enrollments()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You must be enrolled in the class to rate it.');
        }

        // Update or create rating
        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'workout_class_id' => $class->id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        return back()->with('success', 'Thank you for your rating!');
    }
} 