<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function showDeliveryAddressForm()
    {
        $cartItems = \Cart::getContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop.index')->with('warning', 'Your cart is empty.');
        }

        return view('shop.checkout.delivery-address');
    }

    public function processDeliveryAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request->session()->put('delivery_address', $request->input('delivery_address'));

        return redirect()->route('checkout.confirm-order');
    }

    public function showConfirmOrderForm()
    {
        $deliveryAddress = session('delivery_address');
        $cartItems = \Cart::getContent();

        if (!$deliveryAddress || $cartItems->isEmpty()) {
            return redirect()->route('shop.index')->with('warning', 'Something went wrong with your order.');
        }

        $totalAmount = \Cart::getTotal();

        return view('shop.checkout.confirm-order', compact('deliveryAddress', 'cartItems', 'totalAmount'));
    }

    public function placeOrder(Request $request)
    {
        $deliveryAddress = session('delivery_address');
        $cartItems = \Cart::getContent();
        $totalAmount = \Cart::getTotal();

        if (!$deliveryAddress || $cartItems->isEmpty()) {
            return redirect()->route('shop.index')->with('warning', 'Something went wrong with your order.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'delivery_address' => $deliveryAddress,
            'payment_method' => 'cash_on_delivery',
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        \Cart::clear();
        $request->session()->forget('delivery_address');

        return redirect()->route('shop.order-success', $order->id)
                         ->with('success', 'Your order has been placed. You will pay cash on delivery.');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('shop.checkout.order-success', compact('order'));
    }
}