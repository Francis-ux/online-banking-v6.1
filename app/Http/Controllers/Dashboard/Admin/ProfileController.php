<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileControllerUpdateRequest;
use App\Models\Admin;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    use FileUpload;
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Profile', 'url' => null, 'active' => true] // active state
        ];

        $admin = auth()->guard('admin')->user();

        $data = [
            'title' => 'Profile',
            'breadcrumbs' => $breadcrumbs,
            'admin' => $admin
        ];

        return view('dashboard.admin.profile.index', $data);
    }

    public function update(AdminProfileControllerUpdateRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $admin = Admin::findOrFail(auth()->guard('admin')->user()->id);

            $data = [
                'btc_address' => $request->btc_address,
                'btc_qr_code' => $this->imageInterventionUpdateFile($request, 'btc_qr_code', '/uploads/dashboard/admin/profile/btc_qr_code/', 600, 600, $admin?->btc_qr_code)
            ];

            $admin->update($data);

            DB::commit();

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
