<?php

namespace App\Http\Controllers;

use App\Models\WorkoutClass;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    public function index()
    {
        // Get all upcoming classes with enrollment count
        $classes = WorkoutClass::query()
            ->withCount('enrollments')
            ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->get();

        // Get user's enrolled classes
        $enrolledClasses = Auth::user()
            ->enrollments()
            ->with('workoutClass')
            ->get()
            ->pluck('workoutClass');

        return view('user_home', compact('classes', 'enrolledClasses'));
    }
} 