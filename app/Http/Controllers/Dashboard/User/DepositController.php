<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositControllerBitcoinStoreRequest;
use App\Http\Requests\DepositControllerCardStoreRequest;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\User;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DepositController extends Controller
{
    use FileUpload;
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function index()
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Deposits', 'url' => null, 'active' => true]
        ];

        $deposits = $user->deposits()->latest()->get();

        $data = [
            'title' => 'Deposits',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'deposits' => $deposits
        ];

        return view('dashboard.user.deposit.index', $data);
    }

    public function create(string $deposit)
    {
        $user = User::find(auth('user')->user()->id);

        $deposit = ucfirst($deposit);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Deposits', 'url' => route('user.deposit.index')],
            ['label' => "Make a {$deposit} Deposit", 'url' => null, 'active' => true]
        ];

        $admin = Admin::first();

        $qrCode = QrCode::size(200)->generate('bitcoin:' . $admin->btc_address);

        $data = [
            'title' => "Make a {$deposit} Deposit",
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'deposit' => $deposit,
            'admin' => $admin,
            'qrCode' => $qrCode
        ];

        return view('dashboard.user.deposit.create', $data);
    }

    public function cardStore(DepositControllerCardStoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = auth('user')->user();

            $validated['uuid'] = str()->uuid();
            $validated['user_id'] = $user->id;
            $validated['reference_id'] = generateReferenceId();

            Deposit::create($validated);

            DB::commit();

            return redirect()->route('user.deposit.index')->with('success', 'Card deposit submitted successfully. Awaiting verification.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function bitcoinStore(DepositControllerBitcoinStoreRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $user = auth('user')->user();

            $data = [
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'reference_id' => generateReferenceId(),
                'amount' => $request->amount,
                'wallet_address' => $request->wallet_address,
                'method' => $request->method,
            ];

            $deposit = Deposit::create($data);

            if (!$deposit) {
                DB::rollBack();
                return back()->with('error', 'An error occurred while processing your deposit. Please try again.');
            }

            $deposit->update([
                'proof' => $this->imageInterventionUpdateFile($request, 'proof', '/uploads/dashboard/user/deposit/proof/', 2048, 2048, $deposit?->proof),

            ]);

            DB::commit();

            return redirect()->route('user.deposit.index')->with('success', 'Bitcoin deposit submitted successfully. Awaiting verification.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bitcoin deposit failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function show(string $uuid)
    {
        $deposit = Deposit::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'User Dashboard', 'url' => route('user.dashboard')],
            ['label' => 'Deposits', 'url' => route('user.deposit.index')],
            ['label' => 'Deposit Details', 'url' => null, 'active' => true],
        ];

        $admin = Admin::first();

        $qrCode = QrCode::size(200)->generate('bitcoin:' . $admin->btc_address);

        $data = [
            'title' => 'Deposit Details',
            'breadcrumbs' => $breadcrumbs,
            'deposit' => $deposit,
            'admin' => $admin,
            'qrCode' => $qrCode
        ];

        return view('dashboard.user.deposit.show', $data);
    }
}
