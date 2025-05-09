<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirm Your Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">{{ __('Delivery Address') }}</h3>
            <p>{{ $deliveryAddress }}</p>

            <h3 class="text-lg font-semibold mt-6 mb-4">{{ __('Order Items') }}</h3>
            <ul>
                @foreach ($cartItems as $item)
                    <li class="py-2 border-b">
                        {{ $item->name }} x {{ $item->quantity }} - ${{ $item->price * $item->quantity }}
                    </li>
                @endforeach
            </ul>

            <p class="mt-4 font-semibold">{{ __('Total:') }} ${{ $totalAmount }}</p>
            <p class="text-sm text-gray-600 mt-2">{{ __('Payment Method:') }} Cash on Delivery</p>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('shop.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">{{ __('Back to Shop') }}</a>
                <form method="POST" action="{{ route('checkout.place-order') }}">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Place Order (Cash on Delivery)') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>