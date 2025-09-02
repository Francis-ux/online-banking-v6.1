<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enum\TransactionDirection;
use App\Enum\TransactionStatus;
use App\Enum\TransactionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserTransactionControllerStoreRequest;
use App\Mail\TransactionCompleted;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserTransactionController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Transactions', 'url' => null, 'active' => true],
        ];

        $transactions = $user->transactions()->latest()->get();

        $data = [
            'title' => 'Transactions',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transactions' => $transactions,
            'transactionTypes' => TransactionType::cases(),
            'transactionDirections' => TransactionDirection::cases(),
        ];

        return view('dashboard.admin.user.transaction.index', $data);
    }

    public function store(UserTransactionControllerStoreRequest $request, string $uuid)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            switch ($validated['direction']) {
                case 'debit':
                    if ($user->balance < $validated['amount']) {
                        DB::rollBack();
                        return redirect()->back()->with('error', 'Insufficient balance!');
                    }

                    $user->balance = $user->balance - $validated['amount'];
                    $user->save();
                    break;
                case 'credit':
                    $user->balance = $user->balance + $validated['amount'];
                    $user->save();
                    break;
            }

            $transaction = Transaction::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => $validated['type'],
                'direction' => $validated['direction'],
                'description' => $validated['description']
                    ?? ucfirst($validated['direction']) . " of " . currency($user->currency) . formatAmount($validated['amount']) . " via " . ucfirst($validated['type']),
                'amount' => $validated['amount'],
                'current_balance' => $user->balance,
                'transaction_at' => $validated['transaction_at'],
                'reference_id' => generateReferenceId(),
                'status' => TransactionStatus::Completed->value
            ]);

            $message = match ($validated['direction']) {
                'credit' => "Your account has been credited with " . currency($user->currency) . formatAmount($validated['amount']) .
                    " for {$validated['type']} on " . date('jS M Y, g:i A', strtotime($validated['transaction_at'])) .
                    ". Your new balance is " . currency($user->currency) . formatAmount($user->balance) . ".",

                'debit' => "Your account has been debited with " . currency($user->currency) . formatAmount($validated['amount']) .
                    " for {$validated['type']} on " . date('jS M Y, g:i A', strtotime($validated['transaction_at'])) .
                    ". Your new balance is " . currency($user->currency) . formatAmount($user->balance) . ".",

                default => "A transaction of " . currency($user->currency) . formatAmount($validated['amount']) .
                    " was recorded on your account for {$validated['type']} on " .
                    date('jS M Y, g:i A', strtotime($validated['transaction_at'])) .
                    ". Your balance is " . currency($user->currency) . formatAmount($user->balance) . ".",
            };


            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => $validated['type'],
                'message' => $message,
            ]);

            if ($validated['notification'] == 'email') {
                Mail::to($user->email)->send(new TransactionCompleted($user, $transaction, 'Transaction Completed'));
            }

            DB::commit();

            return redirect()->route('admin.user.transaction.index', [$user->uuid])->with('success', 'Transaction created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function show(string $uuid, string $transactionUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Transactions', 'url' => null, 'url' => route('admin.user.transaction.index', $user->uuid)],
            ['label' => 'Transaction Details', 'url' => null, 'active' => true],
        ];

        $transaction = $user->transactions()->where('uuid', $transactionUUID)->first();

        $data = [
            'title' => 'Transaction Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transaction' => $transaction,
        ];

        return view('dashboard.admin.user.transaction.show', $data);
    }
    public function delete(string $uuid, string $transactionUUID)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            $transaction = $user->transactions()->where('uuid', $transactionUUID)->first();

            $transaction->delete();

            DB::commit();

            return redirect()->route('admin.user.transaction.index', [$user->uuid])->with('success', 'Transaction deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
