@extends('layouts.trainerlayout')

@section('content')
<div class="p-8 bg-white">
    <h2 class="text-3xl font-bold mb-6 text-gray-700">Sold Gym Equipments</h2>
    @if ($orders->isEmpty())
        <p>No orders have been placed yet.</p>
    @else
        <table class="table-auto w-full border border-gray-400">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Product Name</th>
                    <th class="border px-4 py-2">Buyer Name</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Address</th>
                    <th class="border px-4 py-2">Delivery Option</th>
                    <th class="border px-4 py-2">Ordered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $order->equipment->product_name ?? 'Deleted Product' }}</td>
                        <td class="border px-4 py-2">{{ $order->name }}</td>
                        <td class="border px-4 py-2">{{ $order->phone }}</td>
                        <td class="border px-4 py-2">{{ $order->address }}</td>
                        <td class="border px-4 py-2">{{ $order->delivery_option }}</td>
                        <td class="border px-4 py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
