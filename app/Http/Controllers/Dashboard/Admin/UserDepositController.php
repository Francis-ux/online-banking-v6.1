<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enum\NotificationType;
use App\Enum\TransactionDirection;
use App\Enum\TransactionStatus;
use App\Enum\TransactionType;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserDepositControllerConfirmRequest;
use App\Mail\DepositConfirmation;
use App\Models\Deposit;
use App\Models\Notification;
use App\Models\Transaction;
use App\Trait\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserDepositController extends Controller
{
    use FileUpload;

    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Deposits', 'url' => null, 'active' => true],
        ];

        $deposits = $user->deposits()->latest()->get();

        $data = [
            'title' => 'Deposits',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'deposits' => $deposits,
        ];

        return view('dashboard.admin.user.deposit.index', $data);
    }

    public function show(string $uuid, string $depositUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Deposits', 'url' => route('admin.user.deposit.index', $user->uuid)],
            ['label' => 'Deposit Details', 'url' => null, 'active' => true],
        ];

        $deposit = Deposit::where('user_id', $user->id)->where('uuid', $depositUUID)->first();

        $admin = Admin::first();

        $qrCode = QrCode::size(200)->generate('bitcoin:' . $admin->btc_address);

        $data = [
            'title' => 'Deposit Details',
            'breadcrumbs' => $breadcrumbs,
            'deposit' => $deposit,
            'user' => $user,
            'admin' => $admin,
            'qrCode' => $qrCode
        ];

        return view('dashboard.admin.user.deposit.show', $data);
    }

    public function confirm(AdminUserDepositControllerConfirmRequest $request, string $id, string $depositUUID)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', $id)->first();

            $deposit = Deposit::where('user_id', $user->id)->where('uuid', $depositUUID)->first();

            $validated['status'] == 1 ? $deposit->status = 1 : $deposit->status;

            $deposit->save();

            // Update user balance
            $user->balance += $deposit->amount;
            $user->save();

            // Save transaction
            $transaction = Transaction::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => TransactionType::Deposit->value,
                'direction' => TransactionDirection::Credit->value,
                'description' => ucfirst($deposit->method) . ' deposit, Ref: ' . $deposit->reference_id,
                'amount' => $deposit->amount,
                'current_balance' => $user->balance,
                'transaction_at' => now(),
                'reference_id' => $deposit->reference_id,
                'status' => TransactionStatus::Completed->value,
            ]);

            // Save notification
            if ($deposit->method == 'bitcoin') {
                $message = 'Your' . ' ' . ucfirst($deposit->method) . ' ' .  'deposit of' . ' ' . currency($deposit->user->currency) . $deposit->amount . ' ' . 'to' . ' ' . $deposit->wallet_address . ' ' . 'is confirmed and added to your balance.';
            } else {
                $message = 'Your' . ' ' . ucfirst($deposit->method) . ' ' .  'deposit of' . ' ' . currency($deposit->user->currency) . $deposit->amount . ' ' . 'is confirmed and added to your balance.';
            }

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => NotificationType::Deposit->value,
                'message' => $message,
            ]);

            // Send email
            Mail::to($user->email)->send(new DepositConfirmation($user, $transaction, 'Deposit Confirmed'));

            DB::commit();

            return redirect()->back()->with('success', 'Deposit confirmed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function delete(string $id, string $depositUUID)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $id)->first();

            $deposit = Deposit::where('user_id', $user->id)->where('uuid', $depositUUID)->first();

            $oldFile = $deposit->proof;

            if ($deposit->delete()) {
                $this->deleteFile($oldFile);
            }

            DB::commit();
            return redirect()->route('admin.user.deposit.index', [$user->uuid])->with('success', 'Deposit deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
