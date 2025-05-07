@extends('layouts.trainerlayout') {{-- This extends the layout --}}

@section('content')
@if (session('add_success'))
    <div id="successMessage" class="fixed bottom-5 right-5 bg-white border border-gray-400 text-black-700 h-9 w-70 items-center text-center">
        {{ session('add_success') }}
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
@endsection