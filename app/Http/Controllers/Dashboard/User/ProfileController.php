<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileControllerUpdateRequest;
use App\Models\User;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    use FileUpload;

    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function index()
    {
        $user = auth('user')->user();

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Profile', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Profile',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];
        return view('dashboard.user.profile.index', $data);
    }

    public function edit()
    {
        $user = auth('user')->user();

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Profile', 'url' => route('user.profile.index')],
            ['label' => 'Edit Profile', 'url' => null, 'active' => true]
        ];


        $data = [
            'title' => 'Edit Profile',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];
        return view('dashboard.user.profile.edit', $data);
    }

    public function update(UserProfileControllerUpdateRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', auth('user')->user()->uuid)->first();

            $validated['image'] = $this->imageInterventionUpdateFile($request, 'image', '/uploads/dashboard/user/image/', 400, 400, $user?->image);

            $user->update($validated);

            DB::commit();
            return redirect()->route('user.profile.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
