<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function index()
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Transactions', 'url' => null, 'active' => true]
        ];

        $transactions = $user->transactions()->latest()->get();

        $data = [
            'title' => 'Transactions',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transactions' => $transactions
        ];

        return view('dashboard.user.transaction.index', $data);
    }

    public function show(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Transactions', 'url' => null, 'url' => route('user.transaction.index')],
            ['label' => 'Transaction Details', 'url' => null, 'active' => true]
        ];

        $transaction = $user->transactions()->where('uuid', $uuid)->first();

        $data = [
            'title' => 'Transaction Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transaction' => $transaction
        ];

        return view('dashboard.user.transaction.show', $data);
    }
}
