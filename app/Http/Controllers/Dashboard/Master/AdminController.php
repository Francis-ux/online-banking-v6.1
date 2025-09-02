<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdminControllerUpdateRequest;
use App\Models\Admin;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    use FileUpload;
    public function index()
    {

        $breadcrumbs = [
            ['label' => 'Master Admin Dashboard', 'url' => route('master.dashboard')],
            ['label' => 'Admins', 'url' => null, 'active' => true],
        ];

        $admins = Admin::latest()->get();

        $data = [
            'title' => 'Admins',
            'breadcrumbs' => $breadcrumbs,
            'admins' => $admins
        ];

        return view('dashboard.master.admin.index', $data);
    }

    public function edit(string $uuid)
    {
        $admin = Admin::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Master Admin Dashboard', 'url' => route('master.dashboard')],
            ['label' => 'Admins', 'url' => route('master.admin.index')],
            ['label' => $admin->name, 'url' => null, 'active' => true],
        ];

        $data = [
            'title' => 'Edit Admin',
            'breadcrumbs' => $breadcrumbs,
            'admin' => $admin
        ];

        return view('dashboard.master.admin.edit', $data);
    }

    public function update(MasterAdminControllerUpdateRequest $request, string $uuid)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $admin = Admin::where('uuid', $uuid)->first();

            $validatedData['btc_qr_code'] = $this->imageInterventionUpdateFile($request, 'btc_qr_code', '/uploads/dashboard/admin/profile/btc_qr_code/', 600, 600, $admin?->btc_qr_code);

            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($request->password);
            } else {
                unset($validatedData['password']);
            }

            $admin->update($validatedData);

            DB::commit();
            return redirect()->route('master.admin.index')->with('success', 'Admin updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
