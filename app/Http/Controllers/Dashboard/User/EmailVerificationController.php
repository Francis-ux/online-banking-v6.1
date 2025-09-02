<?php

namespace App\Http\Controllers\Dashboard\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EmailVerificationControllerStoreRequest;

class EmailVerificationController extends Controller
{
    public function index()
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Email Verification', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Email Verification',
            'breadcrumbs' => $breadcrumbs
        ];

        return view('dashboard.user.email_verification.index', $data);
    }

    public function store(EmailVerificationControllerStoreRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $user = User::findOrFail(auth('user')->user()->id);

            if ($user->email_code == $request->code) {
                $user->email_verified_at = Carbon::now();
                $user->save();

                DB::commit();

                return redirect()->route('user.dashboard')->with('success', 'Email verified successfully');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Invalid email verification code');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
    public function resend()
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail(auth('user')->user()->id);

            $user->email_code = getRandomNumber(6);
            $user->save();

            Mail::to($user->email)->send(new EmailVerification($user, 'Email Verification Code'));

            DB::commit();

            return redirect()->route('user.email.verification.index')->with('success', 'Email verification code sent successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
