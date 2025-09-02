<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginVerificationControllerStoreRequest;
use App\Mail\LoginVerificationNotification;
use Illuminate\Support\Facades\Log;

class LoginVerificationController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found');
        }

        $data = [
            'title' => 'Login Verification',
            'user'  => $user
        ];

        return view('auth.login_verification', $data);
    }

    public function store(LoginVerificationControllerStoreRequest $request)
    {
        $request->validated();

        try {
            // Combine all digits into a single string
            $code = implode('', $request->code);

            $user = User::where('uuid', $request->uuid)->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found');
            }

            if ($user->login_code == $code) {
                auth('user')->login($user);
                return redirect()->route('user.dashboard')->with('success', 'Login successful');
            } else {
                return redirect()->back()->with('error', 'Invalid code. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function resend(Request $request)
    {
        try {
            $user = User::where('uuid', $request->uuid)->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found');
            }

            $user->login_code = getRandomNumber(6);
            $user->save();

            Mail::to($user->email)->send(new LoginVerificationNotification($user, 'Account Login Code'));

            return redirect()->route('login.verification', ['uuid' => $user->uuid])->with('success', 'We sent you a code , please enter it below to verify your email.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
