<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enum\LoanRepaymentStatus;
use App\Enum\LoanStatus;
use App\Enum\NotificationType;
use App\Enum\TransactionDirection;
use App\Enum\TransactionStatus;
use App\Enum\TransactionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoanControllerStoreRequest;
use App\Mail\LoanRepaidNotification;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoanController extends Controller
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
            ['label' => 'Apply for Loan', 'url' => null, 'active' => true]
        ];

        $loans = $user->loans()->latest()->get();

        $data = [
            'title' => 'Apply for Loan',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'loans' => $loans
        ];

        return view('dashboard.user.loan.index', $data);
    }

    public function store(UserLoanControllerStoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $setting = Setting::first();

            $interestRate = $setting->loan_interest_rate;
            $totalRepayable = $validated['amount'] * (1 + ($interestRate / 100) * ($validated['duration_months'] / 12));

            $user = User::find(auth('user')->user()->id);

            $loan = Loan::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'amount' => $validated['amount'],
                'interest_rate' => $interestRate,
                'duration_months' => $validated['duration_months'],
                'total_repayable' => $totalRepayable,
                'purpose' => $validated['purpose'],
                'status' => LoanStatus::Pending->value,
                'reference_id' => generateReferenceId(),
            ]);

            // Create loan repayment
            LoanRepayment::create([
                'uuid' => str()->uuid(),
                'loan_id' => $loan->id,
                'amount' => $totalRepayable,
            ]);

            // Create notification
            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $loan->user_id,
                'type' => NotificationType::LoanApplication->value,
                'message' => "Loan application of " . currency($loan->user->currency) . formatAmount($validated['amount']) . " (Ref: {$loan->reference_id}) submitted.",
            ]);

            DB::commit();
            return redirect()->route('user.loan.index')->with('success', 'Loan application submitted. Awaiting approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Loan application failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function show(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Loans', 'url' => route('user.loan.index')],
            ['label' => 'Loan Details', 'url' => null, 'active' => true]
        ];

        $loan = $user->loans()->where('uuid', $uuid)->first();

        $data = [
            'title' => 'Loan Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'loan' => $loan,
        ];

        return view('dashboard.user.loan.show', $data);
    }

    public function repay(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $loan = $user->loans()->where('uuid', $uuid)->first();

        if ($loan->status->value !== LoanStatus::Active->value) {
            return back()->with('error', 'Loan is not active.');
        }

        $loanRepayment = $loan->loanRepayments()->where('status', LoanRepaymentStatus::PENDING->value)->first();
        if (!$loanRepayment || $loanRepayment->status === LoanRepaymentStatus::PAID->value) {
            return back()->with('error', 'No pending repayments.');
        }

        if ($user->balance < $loanRepayment->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        try {
            DB::beginTransaction();
            $user->balance -= $loanRepayment->amount;
            $user->save();

            $loanRepayment->status = LoanRepaymentStatus::PAID->value;
            $loanRepayment->repaid_at = now();
            $loanRepayment->save();

            $loan->status = LoanStatus::Repaid->value;
            $loan->save();

            // Create transaction
            Transaction::create([
                'uuid' => str()->uuid(),
                'user_id' => $loan->user_id,
                'type' => TransactionType::Payment->value,
                'direction' => TransactionDirection::Debit->value,
                'description' => "Loan repayment for Ref: {$loan->reference_id}",
                'amount' => $loanRepayment->amount, // Debit
                'current_balance' => $user->balance,
                'transaction_at' => now(),
                'reference_id' => $loan->reference_id,
                'status' => TransactionStatus::Completed->value,
            ]);

            // Create notification
            $message = "Loan of {$user->currency} {$loan->amount} (Ref: {$loan->uuid}) fully repaid.";

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => NotificationType::LoanRepaid->value,
                'message' => $message,
            ]);

            // Send email
            Mail::to($user->email)->send(new LoanRepaidNotification($user, $loan, 'Loan Repaid Notification'));

            DB::commit();
            return redirect()->route('user.loan.show', $loan->uuid)->with('success', 'Repayment successful.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Loan repayment failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
