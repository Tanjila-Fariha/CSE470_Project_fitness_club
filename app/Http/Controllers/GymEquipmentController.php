<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\GymEquipment;
use App\Models\SoldProduct;

class GymEquipmentController extends Controller
{
   

public function index() {
    $equipments = GymEquipment::all();
    return view('buy-gym-equipments', compact('equipments'));
}


public function orderForm($id) {
    $equipment = GymEquipment::findOrFail($id);
    return view('order-form', compact('equipment'));
}

public function orderSubmit(Request $request) {
    SoldProduct::create($request->all());
    return redirect()->route('buy.equipments')->with('success', 'Order placed successfully!');
}


}
