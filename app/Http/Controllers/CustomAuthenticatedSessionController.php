<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Models\Trainer;

class CustomAuthenticatedSessionController extends Controller
{
    public function create()
    {
        // If the user is already logged in, redirect them to home
        if (Auth::check()) {
            $user = Auth::user();

            if (Trainer::where('user_id', $user->id)->exists()) {
            return redirect('/trainer_home');
            }
            else {
              return redirect('/user_home');  
            }  // or any other page you want to redirect to
        }

        return view('auth.login');
    }
}
