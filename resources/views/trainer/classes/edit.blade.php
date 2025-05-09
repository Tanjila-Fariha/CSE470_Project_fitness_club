@extends('layouts.trainerlayout')
@section('title', 'Edit Workout Class')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Edit Workout Class') }}
                    </h2>
                    <form method="POST" action="{{ route('trainers.classes.update', $workoutClass->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Type:') }}</label>
                            <input type="text" name="type" id="type" value="{{ $workoutClass->type }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('type')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Start Time:') }}</label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ $workoutClass->start_time }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('start_time')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="capacity" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Capacity:') }}</label>
                            <input type="number" name="capacity" id="capacity" value="{{ $workoutClass->capacity }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('capacity')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description:') }}</label>
                            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $workoutClass->description }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Update Class') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection