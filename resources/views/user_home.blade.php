@extends('layouts.app') {{-- This extends the layout --}}

@section('content')
@if (session('success'))
    <div id="successMessage" class="fixed bottom-5 right-5 bg-white border border-gray-400 text-black-700 h-9 w-70 items-center text-center">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('successMessage');
            if (msg) {
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 1000); // Optional: remove from DOM after fade out
            }
        }, 5000); // 5 seconds
    </script>
@endif

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Available Classes Section -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    {{ __('Available Workout Classes') }}
                </h2>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($classes as $class)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
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

        <!-- My Enrolled Classes Section -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    {{ __('My Enrolled Classes') }}
                </h2>

                @if($enrolledClasses->isEmpty())
                    <p class="text-gray-600">You haven't enrolled in any classes yet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrolledClasses as $class)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
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
                                            <div class="flex items-center space-x-2" id="starRating_{{ $class->id }}">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}_{{ $class->id }}" class="hidden" {{ $class->userRating ? ($class->userRating->rating == $i ? 'checked' : '') : '' }}>
                                                    <label for="rating{{ $i }}_{{ $class->id }}" class="cursor-pointer text-2xl text-gray-300 star-label" data-rating="{{ $i }}">★</label>
                                                @endfor
                                            </div>
                                            <textarea name="comment" placeholder="Write a review (optional)" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $class->userRating ? $class->userRating->comment : '' }}</textarea>
                                            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                {{ $class->userRating ? 'Update Rating' : 'Submit Rating' }}
                                            </button>
                                        </form>
                                    </div>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Get all star rating containers
                                        const starContainers = document.querySelectorAll('[id^="starRating_"]');
                                        
                                        starContainers.forEach(container => {
                                            const stars = container.querySelectorAll('.star-label');
                                            const inputs = container.querySelectorAll('input[type="radio"]');
                                            
                                            // Set initial state based on checked input
                                            const checkedInput = container.querySelector('input[type="radio"]:checked');
                                            if (checkedInput) {
                                                const rating = parseInt(checkedInput.value);
                                                updateStars(stars, rating);
                                            }
                                            
                                            // Add click event to each star
                                            stars.forEach(star => {
                                                star.addEventListener('click', function() {
                                                    const rating = parseInt(this.dataset.rating);
                                                    const input = document.getElementById(this.getAttribute('for'));
                                                    input.checked = true;
                                                    updateStars(stars, rating);
                                                });
                                                
                                                // Add hover effects
                                                star.addEventListener('mouseenter', function() {
                                                    const rating = parseInt(this.dataset.rating);
                                                    updateStars(stars, rating, true);
                                                });
                                                
                                                star.addEventListener('mouseleave', function() {
                                                    const checkedInput = container.querySelector('input[type="radio"]:checked');
                                                    const rating = checkedInput ? parseInt(checkedInput.value) : 0;
                                                    updateStars(stars, rating);
                                                });
                                            });
                                        });
                                        
                                        function updateStars(stars, rating, isHover = false) {
                                            stars.forEach(star => {
                                                const starRating = parseInt(star.dataset.rating);
                                                if (starRating <= rating) {
                                                    star.style.color = '#fbbf24'; // yellow-400
                                                } else {
                                                    star.style.color = '#d1d5db'; // gray-300
                                                }
                                            });
                                        }
                                    });
                                    </script>

                                    <form action="{{ route('user.classes.unenroll', $class->id) }}" method="POST">
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