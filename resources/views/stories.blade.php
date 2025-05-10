
@extends('layouts.app')

@section('content')
<div class="bg-black py-10 px-5 min-h-screen">
    <h2 class="text-4xl font-bold text-white text-center mb-8">All Success Stories</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($stories as $story)
        

            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $story->title }}</h3>
                <p class="mb-2"><strong>By:</strong> {{ $story->name }}</p>
                <p class="h-32 overflow-y-auto mb-2">{{ $story->story }}</p>
                <p class="text-sm text-gray-300">Submitted on: {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}</p>
            </div>
            <div class="flex items-center mt-3 space-x-4">
        <form action="{{ route('stories.like', $story->id) }}" method="POST">
        @csrf
        <button type="submit" class="text-green-400 hover:text-green-600">👍 {{ $story->likes }}</button>
    </form>

    <form action="{{ route('stories.dislike', $story->id) }}" method="POST">
        @csrf
        <button type="submit" class="text-red-400 hover:text-red-600">👎 {{ $story->dislikes }}</button>
    </form>
</div>


        @endforeach
    </div>
    

</div>
@endsection



