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



}


