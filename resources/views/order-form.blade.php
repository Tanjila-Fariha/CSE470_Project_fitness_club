@extends('layouts.app')
@section('title', 'Order Form')

@section('content')

<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md mt-10"> 
    <h2 class="text-2xl font-bold mb-4">Order: {{ $equipment->product_name }}</h2>
    <form action="{{ route('order.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input name="name" required class="w-full border border-gray-300 p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Phone Number</label>
            <input name="phone" required class="w-full border border-gray-300 p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Address</label>
            <textarea name="address" required class="w-full border border-gray-300 p-2 rounded"></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Delivery Option</label>
            <select name="delivery_option" required class="w-full border border-gray-300 p-2 rounded">
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Confirm Order</button>
    </form>
</div>
@endsection 
