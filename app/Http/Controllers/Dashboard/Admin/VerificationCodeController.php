<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationCodeControllerStoreRequest;
use App\Http\Requests\VerificationCodeControllerUpdateRequest;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerificationCodeController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Verification Code', 'url' => null, 'active' => true],
        ];

        $admin = auth()->guard('admin')->user();

        $verificationCodes = VerificationCode::latest()->get();

        $data = [
            'title' => 'Verification Code',
            'breadcrumbs' => $breadcrumbs,
            'admin' => $admin,
            'verificationCodes' => $verificationCodes
        ];

        return view('dashboard.admin.verification_code.index', $data);
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Verification Code', 'url' => route('admin.verification.code.index')],
            ['label' => 'Create Verification Code', 'url' => null, 'active' => true],
        ];

        $admin = auth()->guard('admin')->user();

        $users = User::latest()->get();

        $data = [
            'title' => 'Create Verification Code',
            'breadcrumbs' => $breadcrumbs,
            'admin' => $admin,
            'users' => $users
        ];

        return view('dashboard.admin.verification_code.create', $data);
    }

    public function store(VerificationCodeControllerStoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $validated['uuid'] = str()->uuid();
            VerificationCode::create($validated);

            DB::commit();

            return redirect()->route('admin.verification.code.index')->with('success', 'Verification code created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.verification.code.index')->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function show(string $uuid)
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Verification Code', 'url' => route('admin.verification.code.index')],
            ['label' => 'Verification Code Details', 'url' => null, 'active' => true],
        ];

        $admin = auth()->guard('admin')->user();

        $users = User::latest()->get();

        $verificationCode = VerificationCode::where('uuid', $uuid)->first();

        if (!$verificationCode) {
            return redirect()->route('admin.verification.code.index')->with('error', 'Verification code not found.');
        }

        $data = [
            'title' => 'Verification Code Details',
            'breadcrumbs' => $breadcrumbs,
            'admin' => $admin,
            'users' => $users,
            'verificationCode' => $verificationCode
        ];

        return view('dashboard.admin.verification_code.show', $data);
    }
    public function edit(string $uuid)
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Verification Code', 'url' => route('admin.verification.code.index')],
            ['label' => 'Edit Verification Code', 'url' => null, 'active' => true],
        ];

        $admin = auth()->guard('admin')->user();

        $users = User::latest()->get();

        $verificationCode = VerificationCode::where('uuid', $uuid)->first();

        if (!$verificationCode) {
            return redirect()->route('admin.verification.code.index')->with('error', 'Verification code not found.');
        }

        $data = [
            'title' => 'Edit Verification Code',
            'breadcrumbs' => $breadcrumbs,
            'admin' => $admin,
            'users' => $users,
            'verificationCode' => $verificationCode
        ];

        return view('dashboard.admin.verification_code.edit', $data);
    }

    public function update(VerificationCodeControllerUpdateRequest $request, string $uuid)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $verificationCode = VerificationCode::where('uuid', $uuid)->first();

            $verificationCode->update($validated);

            DB::commit();

            return redirect()->route('admin.verification.code.index')->with('success', 'Verification code updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.verification.code.index')->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function delete(string $uuid)
    {
        try {
            DB::beginTransaction();

            $verificationCode = VerificationCode::where('uuid', $uuid)->first();

            $verificationCode->delete();

            DB::commit();

            return redirect()->route('admin.verification.code.index')->with('success', 'Verification code deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.verification.code.index')->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
