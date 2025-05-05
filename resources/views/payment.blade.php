@extends('layouts.app') {{-- Ensure this is the correct path --}}

@section('content')
<div class="bg-white text-center text-black z-50 pt-5 w-full min-h-[calc(100vh-4rem)]">
    <h3 class="text-5xl font-bold mb-4 text-gray-600">Membership Options</h3>
    <form method="POST" class="text-2xl" action="{{ route('payment.submit') }}">
        @csrf
        <div class="text-gray-600 flex flex-col space-y-6">
        <label class="block items-center font-semibold">Enter your BKash number below</label>
        <div class="justify-center items center text-center">
        <input type="text" name="BKash_number" value="Enter here" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
        </div>
        <label class="block items-center font-semibold">Enter your BKash password below</label>
            <div class="justify-center items center text-center">
                <input type="password" name="password" class="border border-gray-600 p-2 rounded-md w-60 h-8 justify-center items-center"><br>
            </div>
        <label class="block items-center">Amount(in TK)</label>
        <div class="justify-center items center text-center">
        @php
            $membership = session('pending_membership.membership');
        @endphp
        @if ($membership=='1')
            <input type="text" name="amount" value="12000" readonly class="border border-gray-400 p-2 rounded">

        @elseif ($membership=='2')
            <input type="text" name="amount" value="20000" readonly class="border border-gray-400 p-2 rounded">

        @endif
        </div>
        <div class="justify-center items center text-center">

        <input type="submit" value="Submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition justify center" />
        </div>
    </div>
    </form>
</div>
@endsection