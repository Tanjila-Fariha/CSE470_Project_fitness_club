<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class success extends Controller
{
    // Show the success story form (only for members)
    public function index(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to submit a success story.');
        }

        $user = Auth::user();

        // Check if user is a member
        $isMember = Member::where('user_id', $user->id)->exists();

        if (!$isMember) {
            return redirect()->back()->with('error', 'Only members can submit success stories.');
        }

        return view('success');
    }

    // Handle story form submission
    public function successPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'story' => 'required|string|max:10000',
        ]);

        Story::create([
            'name' => $request->name,
            'title' => $request->title,
            'story' => $request->story,
        ]);

        return back()->with('success', 'Your story has been submitted!');
    }

    // Show all stories
    public function showStories()
    {
        $stories = Story::latest()->get();
        return view('stories', compact('stories'));
    }

    // Like a story
    public function like($id)
    {
        $story = Story::findOrFail($id);
        $story->increment('likes');
        return back();
    }

    // Dislike a story
    public function dislike($id)
    {
        $story = Story::findOrFail($id);
        $story->increment('dislikes');
        return back();
    }
}
