@extends('layouts.app')
@section('title', 'Available Classes')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Available Workout Classes') }}
                    </h2>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($classes as $class)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $class->type }}</h3>
                                    <p class="text-gray-600 mb-2">
                                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($class->start_time)->format('F j, Y, g:i a') }}
                                    </p>
                                    <p class="text-gray-600 mb-2">
                                        <strong>Available Spots:</strong> {{ $class->capacity - $class->enrollments_count }}
                                    </p>
                                    <p class="text-gray-600 mb-2">
                                        <strong>Description:</strong> {{ $class->description }}
                                    </p>
                                    
                                    <!-- Rating Display -->
                                    <div class="mb-4">
                                        <div class="flex items-center space-x-1">
                                            @php
                                                $averageRating = $class->ratings->avg('rating') ?? 0;
                                                $ratingCount = $class->ratings->count();
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="text-xl {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                            @endfor
                                            <span class="text-sm text-gray-600 ml-2">
                                                ({{ number_format($averageRating, 1) }} - {{ $ratingCount }} {{ Str::plural('rating', $ratingCount) }})
                                            </span>
                                        </div>
                                        @if($ratingCount > 0)
                                            <div class="mt-2 text-sm text-gray-600">
                                                <p class="font-medium">Latest Reviews:</p>
                                                @foreach($class->ratings->take(2) as $rating)
                                                    <div class="mt-1">
                                                        <p class="text-gray-800">{{ $rating->user->name }}</p>
                                                        <p class="text-gray-600">{{ Str::limit($rating->comment, 100) }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @if($class->capacity > $class->enrollments_count)
                                        <form action="{{ route('user.classes.enroll', $class->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                {{ __('Enroll Now') }}
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full bg-gray-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-not-allowed">
                                            {{ __('Class Full') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection