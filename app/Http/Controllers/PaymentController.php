<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Carbon\Carbon;


class PaymentController extends Controller
{
public function index(Request $request)
{
    //$user = Auth::user(); // full User model
    //$userId = $user->id;
    //$membership = $request->input('membership');
    //$membership = session('membership'); // retrieve flashed session data
    //return view('payment', compact('membership')); 
    $request->validate([
        'BKash_number' => 'required|digits:11|numeric',
        'password' => 'required|string',
        'amount' => 'required',
    ]);

    $data = session('pending_membership');
    $userId = $data['user_id'];
    $membership = $data['membership'];
    $monthsToAdd = 0;

    if ($data['membership'] == 1) {
        $monthsToAdd = 6;
    } elseif ($data['membership'] == 2) {
        $monthsToAdd = 12;
    }

    $validity = Carbon::now()->addMonths($monthsToAdd);
    // Insert into the memberships table
    Member::create([
        'user_id' => $data['user_id'],
        'membership' => $data['membership'],
        'validity' => $validity,
    ]);
    // Optionally clear session
    session()->forget('pending_membership');

    // Redirect with success message
    return redirect()->route('user_home')->with('success', 'Membership activated successfully!');

}
}