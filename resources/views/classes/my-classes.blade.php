@extends('layouts.app')
@section('title', 'My Classes')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('My Enrolled Classes') }}
                    </h2>

                    @if($enrolledClasses->isEmpty())
                        <p class="text-gray-600">You haven't enrolled in any classes yet.</p>
                        <a href="{{ route('user.classes.index') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Browse Available Classes') }}
                        </a>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($enrolledClasses as $class)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $class->type }}</h3>
                                        <p class="text-gray-600 mb-2">
                                            <strong>Time:</strong> {{ \Carbon\Carbon::parse($class->start_time)->format('F j, Y, g:i a') }}
                                        </p>
                                        <p class="text-gray-600 mb-2">
                                            <strong>Description:</strong> {{ $class->description }}
                                        </p>
                                        
                                        <!-- Rating Section -->
                                        <div class="mt-4 mb-4">
                                            <h4 class="text-md font-semibold text-gray-700 mb-2">Rate this class:</h4>
                                            <form action="{{ route('user.classes.rate', $class->id) }}" method="POST" class="space-y-3">
                                                @csrf
                                                <div class="flex items-center space-x-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}_{{ $class->id }}" class="hidden peer" {{ $class->userRating ? ($class->userRating->rating == $i ? 'checked' : '') : '' }}>
                                                        <label for="rating{{ $i }}_{{ $class->id }}" class="cursor-pointer text-2xl peer-checked:text-yellow-400 text-gray-300 hover:text-yellow-400">★</label>
                                                    @endfor
                                                </div>
                                                <textarea name="comment" placeholder="Write a review (optional)" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $class->userRating ? $class->userRating->comment : '' }}</textarea>
                                                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                    {{ $class->userRating ? 'Update Rating' : 'Submit Rating' }}
                                                </button>
                                            </form>
                                        </div>

                                        <form action="{{ route('user.classes.unenroll', $class->id) }}" method="POST" class="mt-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                {{ __('Unenroll') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection