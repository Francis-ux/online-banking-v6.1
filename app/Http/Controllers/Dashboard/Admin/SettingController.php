<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingControllerUpdateRequest;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Setting', 'url' => null, 'active' => true] // active state
        ];

        $data = [
            'title' => 'Setting',
            'breadcrumbs' => $breadcrumbs,
            'setting' => Setting::first()
        ];

        return view('dashboard.admin.setting.index', $data);
    }

    public function update(SettingControllerUpdateRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            Setting::updateOrCreate(
                ['id' => 1],
                [
                    'loan_interest_rate' => $request->loan_interest_rate,
                    'virtual_card_fee' => $request->virtual_card_fee,
                    'physical_card_fee' => $request->physical_card_fee
                ]
            );

            DB::commit();
            return redirect()->route('admin.setting.index')->with('success', 'Setting updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.setting.index')->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
