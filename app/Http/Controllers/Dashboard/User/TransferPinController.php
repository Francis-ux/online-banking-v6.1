<?php

namespace App\Http\Controllers\Dashboard\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferPinControllerStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TransferPinController extends Controller
{
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function index()
    {
        $user = auth('user')->user();

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Create Transfer PIN', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Create Transfer PIN',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];

        return view('dashboard.user.transfer_pin.index', $data);
    }

    public function store(TransferPinControllerStoreRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', auth('user')->user()->uuid)->first();
            if ($user->transfer_pin && $user->transfer_pin_reset_by_admin === 0) {
                DB::rollBack();
                return back()->withErrors(['transfer_pin' => 'PIN already set. Contact support to reset.']);
            }

            $user->transfer_pin = Hash::make($request->transfer_pin);
            $user->transfer_pin_text = $request->transfer_pin;
            $user->transfer_pin_reset_by_admin = 0;
            $user->save();

            DB::commit();

            return redirect()->route('user.profile.index')->with('success', 'Transfer PIN created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
