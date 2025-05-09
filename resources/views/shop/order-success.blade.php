<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Successful') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold mb-4">{{ __('Thank you for your order!') }}</h3>
            <p>{{ __('Your order ID is:') }} {{ $order->id }}</p>
            <p>{{ __('You have chosen to pay cash on delivery.') }}</p>
            <p>{{ __('We will process your order and contact you soon.') }}</p>

            <a href="{{ route('shop.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 focus:outline-none focus:shadow-outline">{{ __('Back to Shop') }}</a>
        </div>
    </div>
</x-app-layout>