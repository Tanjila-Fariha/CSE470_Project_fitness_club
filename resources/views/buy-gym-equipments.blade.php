@extends('layouts.app') <!-- assuming your layout file is named app.blade.php -->

@section('content')


    <div class="grid grid-cols-3 gap-4 p-6 text-white">

    @foreach($equipments as $equipment)
   

    <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
        <img src="{{ asset('storage/' . $equipment->product_image) }}" class="w-full h-48 object-cover rounded" alt="{{ $equipment->product_name }}">
        <h2 class="text-xl font-bold mt-2">{{ $equipment->product_name }}</h2>
        <p class="text-sm mt-1">{{ $equipment->product_description }}</p>
        <p class="text-lg font-semibold mt-2">Price: TK{{ $equipment->price }}</p>
        <p class="text-sm">In stock: {{ $equipment->quantity }}</p>
        <a href="{{ route('order.form', $equipment->id) }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Buy Product</a>
    </div>
    @endforeach
</div>
@endsection
