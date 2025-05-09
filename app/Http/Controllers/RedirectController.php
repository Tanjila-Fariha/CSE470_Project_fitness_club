<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trainer;

class RedirectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (Trainer::where('user_id', $user->id)->exists()) {
            return redirect()->route('trainer_home');
        } else {
            return redirect()->route('user_home');
        }
    }
}