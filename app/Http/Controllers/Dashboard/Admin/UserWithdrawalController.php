<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransferCode;
use App\Models\User;
use Illuminate\Http\Request;

class UserWithdrawalController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Withdrawals', 'url' => null, 'active' => true],
        ];

        $transfers = $user->transfers()->latest()->get();

        $data = [
            'title' => 'Withdrawals',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transfers' => $transfers
        ];

        return view('dashboard.admin.user.withdrawal.index', $data);
    }

    public function show(string $uuid, string $transferUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $transfer = $user->transfers()->where('uuid', $transferUUID)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Withdrawals', 'url' => route('admin.user.withdrawal.index', $user->uuid)],
            ['label' => 'Withdrawal Details', 'url' => null, 'active' => true],
        ];

        $transferCode = new TransferCode();

        $data = [
            'title' => 'Withdrawal Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transfer' => $transfer,
            'transferCodes' => $transferCode->getTransferVerificationData($transfer->reference_id)
        ];

        return view('dashboard.admin.user.withdrawal.show', $data);
    }
}
