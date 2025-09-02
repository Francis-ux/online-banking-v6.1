<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enum\IdentityVerificationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdentityVerificationControllerStoreRequest;
use App\Models\User;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IdentityVerificationController extends Controller
{
    use FileUpload;
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function index()
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Identity Verification', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Identity Verification',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];

        return view('dashboard.user.identity_verification.index', $data);
    }

    public function store(IdentityVerificationControllerStoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', auth('user')->user()->uuid)->first();

            $validated['id_front'] = $this->imageInterventionUpdateFile($request, 'id_front', '/uploads/dashboard/user/ID/id_front/', 1012, 638, $user?->id_front);

            $validated['id_back'] = $this->imageInterventionUpdateFile($request, 'id_back', '/uploads/dashboard/user/ID/id_back/', 1012, 638, $user?->id_back);

            $validated['is_ID_verified'] = IdentityVerificationStatus::Pending->value;

            $user->update($validated);

            DB::commit();
            return redirect()->back()->with('success', 'Identity verification submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
