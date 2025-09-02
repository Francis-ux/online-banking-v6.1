<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enum\UserAccountState;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccountSettingControllerUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserAccountSettingController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Account Setting', 'url' => null, 'active' => true],
        ];

        $userAccountStates = UserAccountState::cases();

        $data = [
            'title' => 'User Account Setting',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'userAccountStates' => $userAccountStates
        ];

        return view('dashboard.admin.user.account_setting.index', $data);
    }

    public function update(UserAccountSettingControllerUpdateRequest $request, string $uuid)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();
            $user->account_state = $request->account_state;
            $user->account_state_reason = $request->account_state_reason;
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Account setting updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
