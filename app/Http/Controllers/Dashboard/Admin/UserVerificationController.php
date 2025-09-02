<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserVerificationController extends Controller
{
    public function skip(string $uuid)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();
            $user->is_account_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->is_ID_verified = 1;
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Verification skipped successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
    public function set(string $uuid)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();
            $user->is_account_verified = 0;
            $user->is_ID_verified = 0;
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Verification set successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
