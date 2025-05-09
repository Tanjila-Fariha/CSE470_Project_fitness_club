@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
    @foreach($equipments as $equipment)
    <div class="bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden">
        
        <!-- Product Image -->
        <div class="h-64 w-full">
            <img src="data:image/jpeg;base64,{{ base64_encode($equipment->product_image) }}"
                 class="w-full h-full object-cover"
                 alt="{{ $equipment->product_name }}">
        </div>

        <!-- Product Info -->
        <div class="p-4">
            <h2 class="text-xl font-bold">{{ $equipment->product_name }}</h2>
            <p class="text-sm mt-1">{{ $equipment->product_description }}</p>
            <p class="text-lg font-semibold mt-2">Price: TK{{ $equipment->price }}</p>
            <p class="text-sm">In stock: {{ $equipment->quantity }}</p>
            <a href="{{ route('order.form', $equipment->id) }}"
               class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
               Buy Product
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection

