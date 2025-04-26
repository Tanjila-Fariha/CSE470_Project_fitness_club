@extends('layouts.app') {{-- Ensure this is the correct path --}}

@section('content')


<div class="bg-white text-center rounded-lg shadow-lg bg-cover z-50 pt-20">
    <h3 class="text-5xl font-bold mb-4">Success Stories</h3>
    
    <form action="{{ route ('success.post') }}" method="POST">
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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
