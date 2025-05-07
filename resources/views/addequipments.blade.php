@extends('layouts.trainerlayout') {{-- This extends the layout --}}

@section('content')
<div class="bg-white text-center text-black z-50 pt-5 w-full min-h-[calc(100vh-4rem)]">
    <h3 class="text-5xl font-bold mb-4 text-gray-600">Add Gym Equipments</h3>
    <form method="POST" class="text-2xl" enctype="multipart/form-data" action="{{ route('AddEquipments.submit') }}">
        @csrf
        <div class="text-gray-600 flex flex-col space-y-6">
        <label class="block items-center font-semibold">Enter product name</label>
        <div class="justify-center items center text-center">
        <input type="text" name="product_name" value="Enter here" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
        </div>
        <label class="block items-center font-semibold">Enter product description</label>
            <div class="justify-center items center text-center">
                <input type="text" name="product_description" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
            </div>
        <label class="block items-center font-semibold">Enter product image</label>
            <div class="justify-center items center text-center">
                <input type="file" name="product_image" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
            </div>
        <label class="block items-center font-semibold">Quantity</label>
            <div class="justify-center items center text-center">
                <input type="text" name="quantity" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
            </div>
        <label class="block items-center font-semibold">Price</label>
            <div class="justify-center items center text-center">
                <input type="text" name="price" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
            </div>
        <div class="justify-center items center text-center">

        <input type="submit" value="Submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition justify center" />
        </div>
    </div>
    </form>
</div>
@endsection