<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AdminUserControllerUpdateRequest;
use App\Mail\TransferPinReset;

class UserController extends Controller
{
    use FileUpload;
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => null, 'active' => true],
        ];

        $users = User::latest()->get();

        $data = [
            'title' => 'Users',
            'breadcrumbs' => $breadcrumbs,
            'users' => $users
        ];
        return view('dashboard.admin.user.index', $data);
    }

    public function show(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'User Details', 'url' => null, 'active' => true],
        ];

        $data = [
            'title' => 'User Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];
        return view('dashboard.admin.user.show', $data);
    }

    public function edit(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Edit User', 'url' => null, 'active' => true],
        ];

        $data = [
            'title' => 'Edit User',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];
        return view('dashboard.admin.user.edit', $data);
    }

    public function update(AdminUserControllerUpdateRequest $request, string $uuid)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            if ($request->filled('password')) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']);
            }

            if ($request->filled('transfer_pin')) {
                $validated['transfer_pin'] = Hash::make($request->transfer_pin);
                $validated['transfer_pin_text'] = $request->transfer_pin;
                $validated['transfer_pin_reset_by_admin'] = true;

                Mail::to($user->email)->send(new TransferPinReset($user, $request->transfer_pin, 'Transfer Pin Reset'));
            } else {
                unset($validated['transfer_pin']);
            }

            $validated['image'] = $this->imageInterventionUpdateFile($request, 'image', '/uploads/dashboard/user/image/', 400, 400, $user?->image);

            $validated['id_front'] = $this->imageInterventionUpdateFile($request, 'id_front', '/uploads/dashboard/user/ID/id_front/', 1012, 638, $user?->id_front);

            $validated['id_back'] = $this->imageInterventionUpdateFile($request, 'id_back', '/uploads/dashboard/user/ID/id_back/', 1012, 638, $user?->id_back);


            $user->update($validated);

            DB::commit();
            return redirect()->route('admin.user.show', ['id' => $user->uuid])->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function delete(string $uuid)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->firstOrFail();

            $image = $user->image;
            $id_front = $user->id_front;
            $id_back = $user->id_back;

            foreach ($user->deposits as $deposit) {
                $this->deleteFile($deposit->proof);
            }

            $this->deleteFile($image);
            $this->deleteFile($id_front);
            $this->deleteFile($id_back);

            $user->delete();

            DB::commit();

            return redirect()->route('admin.user.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()->route('admin.user.index')
                ->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
