@extends('layouts.trainerlayout')
@section('title', 'My Workout Classes')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('My Workout Classes') }}
                    </h2>
                    <a href="{{ route('trainers.classes.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">{{ __('Create New Class') }}</a>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ __('Success!') }}</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Desktop View -->
                    <table class="min-w-full table-auto rounded-lg hidden sm:block">
                        <thead class="justify-between">
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">{{ __('Type') }}</th>
                                <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                <th class="px-4 py-2">{{ __('Capacity') }}</th>
                                <th class="px-4 py-2">{{ __('Description') }}</th>
                                <th class="px-4 py-2">{{ __('Average Rating') }}</th>
                                <th class="px-4 py-2">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900">
                            @foreach ($classes as $class)
                                <tr>
                                    <td class="px-4 py-2">{{ $class->type }}</td>
                                    <td class="px-4 py-2">{{ $class->start_time }}</td>
                                    <td class="px-4 py-2">{{ $class->capacity }}</td>
                                    <td class="px-4 py-2">{{ $class->description }}</td>
                                    <td class="px-4 py-2">
                                        @php
                                            $averageRating = $class->ratings->avg('rating') ?? 0;
                                            $ratingCount = $class->ratings->count();
                                        @endphp
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="text-xl {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                            @endfor
                                            <span class="ml-2">({{ number_format($averageRating, 1) }})</span>
                                        </div>
                                        <button onclick="toggleReviews('{{ $class->id }}')" class="text-blue-500 hover:text-blue-700 text-sm">
                                            {{ __('Show Reviews') }} ({{ $ratingCount }})
                                        </button>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('trainers.classes.edit', $class->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">{{ __('Edit') }}</a>
                                        <form action="{{ route('trainers.classes.destroy', $class->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Reviews Section -->
                                <tr>
                                    <td colspan="6" class="px-4 py-2">
                                        <div id="reviews-{{ $class->id }}" class="hidden bg-gray-50 p-4 rounded-lg">
                                            @if($ratingCount > 0)
                                                @foreach($class->ratings as $rating)
                                                    <div class="border-b border-gray-200 py-3 last:border-0">
                                                        <div class="flex items-center justify-between">
                                                            <span class="font-semibold">{{ $rating->user->name }}</span>
                                                            <div class="flex items-center">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <span class="text-lg {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        @if($rating->comment)
                                                            <p class="text-gray-600 mt-1">{{ $rating->comment }}</p>
                                                        @endif
                                                        <p class="text-sm text-gray-500 mt-1">
                                                            {{ $rating->created_at->format('M d, Y H:i') }}
                                                        </p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-gray-600">{{ __('No reviews yet.') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Mobile View -->
                    <div class="sm:hidden">
                        @foreach ($classes as $class)
                            <div class="bg-gray-100 rounded-lg p-4 mb-2">
                                <h3 class="text-lg font-semibold">{{ $class->type }}</h3>
                                <p>{{ __('Time:') }} {{ $class->start_time }}</p>
                                <p>{{ __('Capacity:') }} {{ $class->capacity }}</p>
                                <p>{{ __('Description:') }} {{ $class->description }}</p>
                                
                                <!-- Rating Section -->
                                @php
                                    $averageRating = $class->ratings->avg('rating') ?? 0;
                                    $ratingCount = $class->ratings->count();
                                @endphp
                                <div class="mt-2">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-xl {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                        @endfor
                                        <span class="ml-2">({{ number_format($averageRating, 1) }})</span>
                                    </div>
                                    <button onclick="toggleReviews('mobile-{{ $class->id }}')" class="text-blue-500 hover:text-blue-700 text-sm">
                                        {{ __('Show Reviews') }} ({{ $ratingCount }})
                                    </button>
                                    
                                    <!-- Mobile Reviews -->
                                    <div id="reviews-mobile-{{ $class->id }}" class="hidden mt-2">
                                        @if($ratingCount > 0)
                                            @foreach($class->ratings as $rating)
                                                <div class="border-b border-gray-200 py-2 last:border-0">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-semibold">{{ $rating->user->name }}</span>
                                                        <div class="flex items-center">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span class="text-lg {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    @if($rating->comment)
                                                        <p class="text-gray-600 mt-1">{{ $rating->comment }}</p>
                                                    @endif
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        {{ $rating->created_at->format('M d, Y H:i') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{{ __('No reviews yet.') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <a href="{{ route('trainers.classes.edit', $class->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-block">{{ __('Edit') }}</a>
                                    <form action="{{ route('trainers.classes.destroy', $class->id) }}" method="POST" class="inline-block mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for toggling reviews -->
    <script>
        function toggleReviews(id) {
            const reviewsDiv = document.getElementById(`reviews-${id}`);
            if (reviewsDiv.classList.contains('hidden')) {
                reviewsDiv.classList.remove('hidden');
            } else {
                reviewsDiv.classList.add('hidden');
            }
        }
    </script>
@endsection