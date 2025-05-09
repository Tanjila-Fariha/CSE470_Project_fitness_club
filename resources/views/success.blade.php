

@extends('layouts.app') {{-- Ensure this is the correct path --}}

@section('content')

<div class="bg-white text-center text-black z-50 pt-5 w-full min-h-[calc(100vh-4rem)]">

<h2 class="text-5xl font-bold mb-8 text-center text-gray-600">Success Stories</h2>
  


    <a href="{{ route('success.stories') }}" class="btn btn-success mb-4">Read Success Stories</a>

    
    <form action="{{ route ('success.post') }}" method="POST" >
      @csrf
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <!-- Name Field -->
    <div class="mb-3">
      <label for="nameInput" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your name">
    </div>


    <!-- Email Field -->
    <div class="mb-3">
      <label for="paragraphInput" class="form-label">Title</label>
      <input type="text" class="form-control" id="pp" name="title" placeholder="Enter your title">
    </div>


      <div class="mb-3">
        <label for="paragraphInput" class="form-label">Write your Success Story (up to 1000 words):</label>
        <textarea class="form-control" id="paragraphInput" rows="6" maxlength="10000" placeholder="Start writing..." name="story"></textarea>
        <div class="form-text">Word limit: 1000 words (approx. 10,000 characters)</div>
      </div>


      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>


      <!-- Blue Submit Button -->
      <input type="submit" value="Submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition justify center" />
    </form>

</div>
@endsection
