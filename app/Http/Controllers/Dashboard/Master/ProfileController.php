<?php

namespace App\Http\Controllers\Dashboard\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterProfileControllerUpdateRequest;
use App\Models\Master;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Master Admin Dashboard', 'url' => route('master.dashboard')],
            ['label' => 'Profile', 'url' => null, 'active' => true] // active state
        ];

        $master = auth()->guard('master')->user();

        $data = [
            'title' => 'Profile',
            'breadcrumbs' => $breadcrumbs,
            'master' => $master
        ];

        return view('dashboard.master.profile.index', $data);
    }

    public function update(MasterProfileControllerUpdateRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $master = Master::findOrFail(auth()->guard('master')->user()->id);

            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($request->password);
            } else {
                unset($validatedData['password']);
            }

            $master->update($validatedData);

            DB::commit();

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
