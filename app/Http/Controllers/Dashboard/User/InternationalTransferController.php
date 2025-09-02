<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enum\NotificationType;
use App\Models\User;
use App\Models\Transfer;
use App\Enum\TransferType;
use App\Models\Transaction;
use App\Enum\TransferStatus;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Enum\TransactionType;
use App\Enum\UserAccountState;
use App\Enum\TransactionStatus;
use App\Enum\TransferRestricted;
use App\Enum\TransactionDirection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternationalTransferControllerStoreRequest;
use App\Http\Requests\InternationalTransferControllerVerifyCodeRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;

class InternationalTransferController extends Controller
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
            ['label' => 'International Transfer', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'International Transfer',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];

        return view('dashboard.user.international_transfer.index', $data);
    }

    public function store(InternationalTransferControllerStoreRequest $request)
    {
        $request->validated();

        $user = User::find(auth('user')->user()->id);

        if (Hash::check($request->transfer_pin, $user->transfer_pin) === false) {
            return redirect()->back()->with('error', 'Invalid PIN');
        }

        if ($user->is_account_verified === 0) {
            return redirect()->back()->withErrors(['account_number' => 'Please verify your account first before proceeding.']);
        }

        if ($user->account_state === UserAccountState::Frozen->value) {
            return redirect()->back()->withErrors(['account_number' => 'Your account is frozen please contact support team for more information.']);
        }

        if ($user->account_state === UserAccountState::Kyc->value) {
            return redirect()->back()->withErrors(['account_number' => 'Your account is under review please contact support team for more information.']);
        }

        if ($user->balance < $request->amount) {
            return redirect()->back()->withErrors(['account_number' => 'Insufficient balance.']);
        }

        try {
            DB::beginTransaction();

            $transfer = new Transfer([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'amount' => $request->amount,
                'description' => $request->description ?? "International transfer of " . currency($user->currency) . formatAmount($request->amount) . " to $request->account_name's $request->bank_name account",
                'swift_code' => $request->swift_code,
                'iban_code' => $request->iban_code,
                'routing_number' => $request->routing_number,
                'reference_id' => generateReferenceId(),
                'type' => TransferType::InternationalTransfer->value,
            ]);

            $transfer->save();

            $transferCode = new TransferCode();
            $transferCode->createTransferCode($transfer->reference_id, $user);

            DB::commit();

            $transferNeedVerificationCode = TransferCode::where('transfer_reference_id', $transfer->reference_id)->where('user_id', $user->id)->first();

            $orderNo = 1;

            if ($transferNeedVerificationCode) {
                return redirect()->route('user.international_transfer.verify', [$transfer->reference_id, $orderNo]);
            } else {
                return redirect()->route('user.international_transfer.approve_success', $transfer->reference_id)->with('success', 'Transfer successful');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function verify($transferReferenceId, $orderNo)
    {
        $user = User::find(auth('user')->user()->id);

        $transfer = $user->transfers()->where('reference_id', $transferReferenceId)->first();

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'International Transfer', 'url' => route('user.international_transfer.index')],
            ['label' => 'Verify Transfer', 'url' => null, 'active' => true]
        ];

        $transferCode = new TransferCode();

        $data = [
            'title' => 'Verify Transfer',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'transfer' => $transfer,
            'transferCodes' => $transferCode->getTransferVerificationData($transfer->reference_id),
            'referenceId' => $transferReferenceId,
            'orderNo' => $orderNo
        ];

        return view('dashboard.user.international_transfer.verify', $data);
    }

    public function verifyCode(InternationalTransferControllerVerifyCodeRequest $request, $transferReferenceId, $orderNo)
    {
        $request->validated();

        $user = User::find(auth('user')->user()->id);

        $transferCode = TransferCode::where('code', $request->code)->where('order_no', $orderNo)->where('transfer_reference_id', $transferReferenceId)->first();

        $transferCodeCounts = TransferCode::where('transfer_reference_id', $transferReferenceId)->where('user_id', $user->id)->count();

        try {
            if ($transferCode) {
                if ($orderNo >= $transferCodeCounts) {
                    return redirect()->route('user.international_transfer.approve_success', $transferReferenceId);
                } else {
                    $orderNo += 1;
                    return redirect()->route('user.international_transfer.verify', [$transferReferenceId, $orderNo]);
                }
            } else {
                return redirect()->back()->withErrors(['code' => 'Invalid code.']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function approveSuccess(string $transferReferenceId)
    {
        $user = User::find(auth('user')->user()->id);

        $transfer = $user->transfers()->where('reference_id', $transferReferenceId)->first();

        try {
            DB::beginTransaction();
            switch ($user->should_transfer_fail) {
                case TransferRestricted::No->value:
                    $user->balance -= $transfer->amount;
                    $user->save();

                    $transfer->status = TransferStatus::Completed->value;
                    $transfer->save();

                    // Create transaction
                    Transaction::create([
                        'uuid' => str()->uuid(),
                        'user_id' => $user->id,
                        'type' => TransactionType::Transfer->value,
                        'direction' => TransactionDirection::Debit->value,
                        'description' => $transfer->description,
                        'amount' => $transfer->amount,
                        'current_balance' => $user->balance,
                        'transaction_at' => now(),
                        'reference_id' => $transfer->reference_id,
                        'status' => TransactionStatus::Completed->value,
                    ]);

                    // Create notification
                    $message = "Your transfer of " . currency($transfer->user->currency) . formatAmount($transfer->amount) . " to " . $transfer->account_name . " was successful.";

                    Notification::create([
                        'uuid' => str()->uuid(),
                        'user_id' => $user->id,
                        'type' => NotificationType::Transfer->value,
                        'message' => $message,
                    ]);

                    DB::commit();

                    return redirect()->route('user.international_transfer.success', $transfer->reference_id)->with('success', 'Transfer Successful');
                default:
                    $transfer->status = TransferStatus::Failed->value;
                    $transfer->save();

                    // Create transaction
                    Transaction::create([
                        'uuid' => str()->uuid(),
                        'user_id' => $user->id,
                        'type' => TransactionType::Transfer->value,
                        'direction' => TransactionDirection::Debit->value,
                        'description' => $transfer->description,
                        'amount' => $transfer->amount,
                        'current_balance' => $user->balance,
                        'transaction_at' => now(),
                        'reference_id'  => $transfer->reference_id,
                        'status' => TransactionStatus::Failed->value,
                    ]);

                    // Create notification
                    $message = "Your transfer of " . currency($transfer->user->currency) . formatAmount($transfer->amount) . " to " . $transfer->account_name . " was not successful.";

                    Notification::create([
                        'uuid' => str()->uuid(),
                        'user_id' => $user->id,
                        'type' => NotificationType::Transfer->value,
                        'message' => $message,
                    ]);

                    DB::commit();

                    return redirect()->route('user.transaction.index')->with('error', 'Transfer Failed');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function success(string $transferReferenceId)
    {
        $user = User::find(auth('user')->user()->id);

        $transfer = $user->transfers()->where('reference_id', $transferReferenceId)->first();

        $transaction = $user->transactions()->where('reference_id', $transfer->reference_id)->first();

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'International Transfer', 'url' => route('user.international_transfer.index')],
            ['label' => 'Transfer Successful', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Transfer Successful',
            'user' => $user,
            'transfer' => $transfer,
            'breadcrumbs' => $breadcrumbs,
            'transaction' => $transaction
        ];

        return view('dashboard.user.international_transfer.success', $data);
    }
}
