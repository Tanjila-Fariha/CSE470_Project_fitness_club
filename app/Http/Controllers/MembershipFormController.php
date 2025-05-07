<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipFormController extends Controller
{
public function index(Request $request)
{
    //$user = Auth::user(); // full User model
    //$userId = $user->id;
    //$membership = $request->input('membership');
    $request->validate([
        'membership' => 'required',
    ]);
    session([
    'pending_membership' => [
        'user_id' => Auth::id(),
        'membership' => $request->input('membership'),
    ]
    ]);
    return redirect()->route('payment')->with('membership',$request->input('membership'));

}
}
