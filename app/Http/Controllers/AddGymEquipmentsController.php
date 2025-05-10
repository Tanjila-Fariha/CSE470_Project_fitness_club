<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Gym_equipment;

class AddGymEquipmentsController extends Controller
{
    public function index()
    {
        return view('addequipments'); 
    }
    public function submit(Request $request)
    {

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_description' => 'required|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
        ]);
        $imagePath = $request->file('product_image')->store('products', 'public');

        // Insert into the memberships table
        Gym_equipment::create([
            'product_name' => $request->product_name,
            'product_image' => $imagePath,
            'product_description' => $request->product_description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);


        // Redirect with success message
        return redirect()->route('trainer_home')->with('add_success', 'Gym Equipments added successfully!');

    }
}

