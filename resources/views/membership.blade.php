@extends('layouts.app') {{-- Ensure this is the correct path --}}

@section('content')
<div class="bg-white text-center text-black z-50 pt-5 w-full min-h-[calc(100vh-4rem)]">

<h2 class="text-5xl font-bold mb-8 text-center text-gray-600">Membership Options</h2>

<form method="POST" action="{{ route('form.submit') }}" class="flex justify-center">
    @csrf

    <div class="flex flex-col space-y-10">
        <!-- 6 Months Option -->
        <label class="cursor-pointer">
            <input type="radio" name="membership" value="1" class="peer hidden" />
            <div class="z-60 opacity-100 w-50 bg-solid h-30 rounded-lg border-2 border-gray-600 flex flex-col items-center justify-center text-center transition-all duration-300 peer-checked:border-gray-500 peer-checked:scale-110 bg-gray-600 text-white opacity-100">
                <div class="text-xl font-semibold">6 Months</div>
                <div class="text-lg">12000 BDT</div>
            </div>
        </label>

        <!-- 12 Months Option -->
        <label class="cursor-pointer">
            <input type="radio" name="membership" value="2" class="peer hidden" />
            <div class="z-60 opacity-100 w-50 bg-solid h-30 rounded-lg border-2 border-gray-600 flex flex-col items-center justify-center text-center transition-all duration-300 peer-checked:border-gray-500 peer-checked:scale-110 bg-gray-600 text-white opacity-100">
                <div class="text-xl font-semibold">12 Months</div>
                <div class="text-lg">20000 BDT</div>
            </div>
        </label>

    <input type="submit" value="Submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition justify center" />
</div>
</form>

</div>
</div>
@endsection