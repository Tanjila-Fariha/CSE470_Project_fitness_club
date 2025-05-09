<?php

namespace App\Http\Controllers;

use App\Models\WorkoutClass;
use App\Models\Trainer;
use App\Models\Notification;
use Illuminate\Http\Request;

class WorkoutClassController extends Controller
{
    public function index()
    {
        // First get the trainer record for the authenticated user
        $trainer = Trainer::where('user_id', auth()->id())->firstOrFail();
        
        $classes = WorkoutClass::with(['ratings.user'])
            ->where('trainer_id', $trainer->id)
            ->get();
        
        return view('trainer.classes.index', compact('classes'));
    }

    public function create()
    {
        // Logic to display the form for creating a new class
        return view('trainer.classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'start_time' => 'required|date|after:now',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $trainer = Trainer::where('user_id', auth()->id())->firstOrFail();
        
        $workoutClass = WorkoutClass::create($validated + ['trainer_id' => $trainer->id]);
        
        // Create notification for all users
        $users = \App\Models\User::whereDoesntHave('trainer')->get();
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'new_class',
                'message' => "New {$workoutClass->type} class available! Starting at " . $workoutClass->start_time->format('F j, Y, g:i a')
            ]);
        }
        
        return redirect()->route('trainers.classes.index')
            ->with('success', 'Class created successfully!');
    }

    public function edit(WorkoutClass $workoutClass)
    {
        // Logic to display the form for editing a class
        return view('trainer.classes.edit', compact('workoutClass'));
    }   

    public function update(Request $request, WorkoutClass $workoutClass)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'start_time' => 'required|date|after:now',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $oldCapacity = $workoutClass->capacity;
        $workoutClass->update($validated);

        // Notify enrolled users about changes
        foreach ($workoutClass->enrollments as $enrollment) {
            Notification::create([
                'user_id' => $enrollment->user_id,
                'type' => 'class_updated',
                'message' => "Your {$workoutClass->type} class has been updated. New start time: " . $workoutClass->start_time->format('F j, Y, g:i a')
            ]);
        }

        // Notify about capacity changes
        if ($oldCapacity != $workoutClass->capacity) {
            foreach ($workoutClass->enrollments as $enrollment) {
                Notification::create([
                    'user_id' => $enrollment->user_id,
                    'type' => 'capacity_change',
                    'message' => "Capacity for {$workoutClass->type} class has been updated to {$workoutClass->capacity} spots"
                ]);
            }
        }

        return redirect()->route('trainers.classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy(WorkoutClass $workoutClass)
    {
        // Notify enrolled users about cancellation
        foreach ($workoutClass->enrollments as $enrollment) {
            Notification::create([
                'user_id' => $enrollment->user_id,
                'type' => 'class_cancelled',
                'message' => "Your {$workoutClass->type} class has been cancelled"
            ]);
        }

        $workoutClass->delete();
        return redirect()->route('trainers.classes.index')->with('success', 'Class deleted successfully!');
    }

    // ... other methods for browsing classes
}