<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Enum\LoanStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\LoanRepayment;
use App\Mail\LoanNotification;
use App\Enum\TransactionStatus;
use App\Enum\LoanRepaymentStatus;
use App\Enum\NotificationType;
use App\Enum\TransactionDirection;
use App\Enum\TransactionType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class UserLoanController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Loans', 'url' => null, 'active' => true],
        ];

        $loans = $user->loans()->latest()->get();

        $data = [
            'title' => 'Loans',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'loans' => $loans,
        ];

        return view('dashboard.admin.user.loan.index', $data);
    }

    public function show(string $uuid, string $loanUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Loans', 'url' => route('admin.user.loan.index', $user->uuid)],
            ['label' => 'Loan Details', 'url' => null, 'active' => true],
        ];

        $loan = $user->loans()->where('uuid', $loanUUID)->first();

        $data = [
            'title' => 'Loan Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'loan' => $loan,
        ];

        return view('dashboard.admin.user.loan.show', $data);
    }

    public function approve(string $uuid, string $loanUUID)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            $loan = $user->loans()->where('uuid', $loanUUID)->first();
            $loan->status = LoanStatus::Active->value;
            $loan->disbursed_at = now();
            $loan->due_at = now()->addMonths($loan->duration_months);
            $loan->save();

            $user->balance += $loan->amount;
            $user->save();

            // Create transaction
            Transaction::create([
                'uuid' => str()->uuid(),
                'user_id' => $loan->user_id,
                'type' => TransactionType::Deposit->value,
                'direction' => TransactionDirection::Credit->value,
                'description' => "Loan disbursement for Ref: {$loan->reference_id}",
                'amount' => $loan->amount,
                'current_balance' => $user->balance,
                'transaction_at' => now(),
                'reference_id' => $loan->reference_id,
                'status' => TransactionStatus::Completed->value,
            ]);

            // Create notification
            $message = "Loan of " . currency($user->currency) . formatAmount($loan->amount) . " (Ref: {$loan->reference_id}) approved and disbursed.";

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => NotificationType::LoanApproved->value,
                'message' => $message,
            ]);

            // Send email
            Mail::to($user->email)->send(new LoanNotification($user, $loan, 'approved', 'Loan approved and disbursed.'));

            DB::commit();

            return redirect()->route('admin.user.loan.show', [$user->uuid, $loan->uuid])->with('success', 'Loan approved and disbursed.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.user.loan.show', [$user->uuid, $loan->uuid])->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function reject(string $uuid, string $loanUUID)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            $loan = $user->loans()->where('uuid', $loanUUID)->first();
            $loan->status = LoanStatus::Rejected->value;
            $loan->save();

            // Delete all loan repayments
            $loan->loanRepayments()->delete();

            // Create notification
            $message = "Loan application of " . currency($loan->user->currency) . formatAmount($loan->amount) . " (Ref: {$loan->reference_id}) rejected.";

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => NotificationType::LoanRejected->value,
                'message' => $message,
            ]);

            Mail::to($loan->user->email)->send(new LoanNotification($loan->user, $loan, 'rejected', 'Your loan has been rejected.'));

            DB::commit();

            return redirect()->route('admin.user.loan.show', [$user->uuid, $loan->uuid])->with('success', 'Loan rejected.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.user.loan.show', [$user->uuid, $loan->uuid])->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
