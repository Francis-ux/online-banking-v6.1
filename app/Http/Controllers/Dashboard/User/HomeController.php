<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enum\CardStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Dashboard', 'active' => true],
        ];

        $transactions = $user->transactions()->latest()->limit(12)->get();

        $cards = $user->cards()->where('status', '!=', CardStatus::Pending->value)->latest()->get();

        $data = [
            'title' => "Welcome, $user->first_name $user->last_name",
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transactions' => $transactions,
            'cards' => $cards
        ];

        return view('dashboard.user.home', $data);
    }
}
