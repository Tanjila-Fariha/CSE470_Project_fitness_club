<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class success extends Controller
{
    // Show form view
    public function index()
    {
        return view('success');
    }


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
    public function showStories()
{
    $stories = Story::latest()->get(); // Fetch all stories, latest first
    return view('stories', compact('stories')); // Make sure you create 'resources/views/stories.blade.php'
}
public function like($id)
{
    $story = Story::findOrFail($id);
    $story->increment('likes');
    return back();
}

public function dislike($id)
{
    $story = Story::findOrFail($id);
    $story->increment('dislikes');
    return back();
}






}


