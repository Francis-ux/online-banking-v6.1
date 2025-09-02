<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Transfer;
use App\Enum\TransferType;
use App\Models\Transaction;
use App\Enum\TransferStatus;
use App\Models\Notification;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Enum\TransactionType;
use App\Enum\NotificationType;
use App\Enum\UserAccountState;
use App\Enum\TransactionStatus;
use App\Enum\TransferRestricted;
use App\Enum\TransactionDirection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LocalTransferControllerStoreRequest;
use App\Http\Requests\LocalTransferControllerVerifyCodeRequest;

class LocalTransferController extends Controller
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
            ['label' => 'Local Transfer', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Local Transfer',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];

        return view('dashboard.user.local_transfer.index', $data);
    }

    public function getAccountNumber(Request $request)
    {
        try {
            $user = User::where('account_number', $request->accountNumber)->first();

            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'account_name' => "{$user->first_name} {$user->last_name}",
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid bank account number. Please check and try again.',
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => env('APP_ERROR_MESSAGE'),
            ]);
        }
    }

    public function store(LocalTransferControllerStoreRequest $request)
    {

        $request->validated();

        // Check if receiver account exists
        $receiverUser = User::where('account_number', $request->account_number)->first();
        if (!$receiverUser) {
            return redirect()->back()->with('error', 'Account not found');
        }

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
            // Transfer
            $transfer = new Transfer([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'bank_name' => env('APP_NAME'),
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'amount' => $request->amount,
                'description' => $request->description ?? "Local transfer of " . currency($user->currency) . formatAmount($request->amount) . " to $request->account_name's $request->bank_name account",
                'reference_id' => generateReferenceId(),
                'type' => TransferType::LocalTransfer->value,
            ]);

            $transfer->save();

            session()->put('receiverAccountNumber', $receiverUser->account_number);
            // Transfer End

            // Transfer Code
            $transferCode = new TransferCode();
            $transferCode->createTransferCode($transfer->reference_id, $user);

            DB::commit();

            $transferNeedVerificationCode = TransferCode::where('transfer_reference_id', $transfer->reference_id)->where('user_id', $user->id)->first();

            $orderNo = 1;

            if ($transferNeedVerificationCode) {
                return redirect()->route('user.local_transfer.verify', [$transfer->reference_id, $orderNo]);
            } else {
                return redirect()->route('user.local_transfer.approve_success', $transfer->reference_id)->with('success', 'Transfer successful');
            }
            // End Transfer Code
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
            ['label' => 'Local Transfer', 'url' => route('user.local_transfer.index')],
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

        return view('dashboard.user.local_transfer.verify', $data);
    }

    public function verifyCode(LocalTransferControllerVerifyCodeRequest $request, $transferReferenceId, $orderNo)
    {
        $request->validated();

        $user = User::find(auth('user')->user()->id);

        $transferCode = TransferCode::where('code', $request->code)->where('order_no', $orderNo)->where('transfer_reference_id', $transferReferenceId)->first();

        $transferCodeCounts = TransferCode::where('transfer_reference_id', $transferReferenceId)->where('user_id', $user->id)->count();

        try {
            if ($transferCode) {
                if ($orderNo >= $transferCodeCounts) {
                    return redirect()->route('user.local_transfer.approve_success', $transferReferenceId);
                } else {
                    $orderNo += 1;
                    return redirect()->route('user.local_transfer.verify', [$transferReferenceId, $orderNo]);
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
        // Check if receiver account exists
        $receiverUser = User::where('account_number', session()->get('receiverAccountNumber'))->first();
        if (!$receiverUser) {
            return redirect()->back()->with('error', 'Account not found');
        }
        // Check if sender account exists
        $user = User::find(auth('user')->user()->id);
        // Check if transfer data exists
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


                    // Receiver
                    $receiverUser->balance += $transfer->amount;
                    $receiverUser->save();

                    // Create transaction
                    Transaction::create([
                        'uuid' => str()->uuid(),
                        'user_id' => $receiverUser->id,
                        'type' => TransactionType::Transfer->value,
                        'direction' => TransactionDirection::Credit->value,
                        'description' => $transfer->description,
                        'amount' => $transfer->amount,
                        'current_balance' => $receiverUser->balance,
                        'transaction_at' => now(),
                        'reference_id' => $transfer->reference_id,
                        'status' => TransactionStatus::Completed->value,
                    ]);

                    // Create notification
                    $receiverUserMessage = "You have received a transfer of " . currency($transfer->user->currency) . formatAmount($transfer->amount) . " from " . $user->first_name . ' ' . $user->last_name . ".";

                    Notification::create([
                        'uuid' => str()->uuid(),
                        'user_id' => $receiverUser->id,
                        'type' => NotificationType::Transfer->value,
                        'message' => $receiverUserMessage,
                    ]);

                    DB::commit();

                    session()->forget('receiverAccountNumber');

                    return redirect()->route('user.local_transfer.success', $transfer->reference_id)->with('success', 'Transfer Successful');
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
                        'reference_id' => $transfer->reference_id,
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
            ['label' => 'Local Transfer', 'url' => route('user.local_transfer.index')],
            ['label' => 'Transfer Successful', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Transfer Successful',
            'user' => $user,
            'transfer' => $transfer,
            'breadcrumbs' => $breadcrumbs,
            'transaction' => $transaction
        ];

        return view('dashboard.user.local_transfer.success', $data);
    }
}
