<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserIdentityVerificationControllerStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserIdentityVerificationController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Identity Verification', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Identity Verification',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];

        return view('dashboard.admin.user.identity_verification.index', $data);
    }

    public function store(UserIdentityVerificationControllerStoreRequest $request, string $uuid)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            $user->is_ID_verified = $validated['status'];

            $validated['status'] == 1 ? $user->is_account_verified = 1 : $user->is_account_verified;

            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Identity verification updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
