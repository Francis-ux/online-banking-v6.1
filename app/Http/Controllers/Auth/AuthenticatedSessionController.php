<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Enum\UserAccountState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AuthenticatedSessionControllerStoreRequest;
use App\Mail\LoginVerificationNotification;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login', ['title' => 'Login your account']);
    }

    public function store(AuthenticatedSessionControllerStoreRequest $request)
    {
        $request->validated();

        try {
            $email_or_account_number = $request->email_or_account_number;
            $password = $request->password;
            $remember = $request->remember;

            $fieldType = filter_var($email_or_account_number, FILTER_VALIDATE_EMAIL) ? 'email' : 'account_number';

            $credentials = [$fieldType => $email_or_account_number, 'password' => $password];

            if (auth('user')->attempt($credentials, $remember)) {
                $user = auth('user')->user();
                if (auth('user')->user()->account_state->value == UserAccountState::Disabled->value) {
                    auth('user')->logout();
                    if ($user->account_state_reason != null) {
                        return back()->with('error', $user->account_state_reason);
                    } else {
                        return back()->with('error', 'Your account has been disabled please contact support for more information.');
                    }
                }

                if (auth('user')->user()->should_login_require_code === 1) {
                    DB::beginTransaction();

                    $user = User::findOrFail(auth('user')->user()->id);
                    $user->login_code = getRandomNumber(6);
                    $user->save();

                    Mail::to($user->email)->send(new LoginVerificationNotification($user, 'Account Login Code'));
                    auth('user')->logout();

                    DB::commit();

                    return redirect()->route('login.verification', ['uuid' => $user->uuid])->with('success', 'We sent you a code , please enter it below to verify your email.');
                }

                return redirect()->route('user.dashboard')->with('success', 'Login successful');
            }

            if (auth('admin')->attempt($credentials, $remember)) {
                if (auth('admin')->user()->status == 0) {
                    auth('admin')->logout();
                    return back()->withErrors([
                        'email_or_account_number' => 'Your account has been disabled please contact support for more information.',
                    ])->onlyInput('email_or_account_number');
                }

                return redirect()->route('admin.dashboard')->with('success', 'Login successful');
            }

            if (auth('master')->attempt($credentials, $remember)) {
                return redirect()->route('master.dashboard')->with('success', 'Login successful');
            }

            return back()->withErrors([
                'email_or_account_number' => 'The provided credentials do not match our records.',
            ])->onlyInput('email_or_account_number');
        } catch (\Exception $e) {
            Log::error('Login failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during login. Please try again.');
        }
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();

            if ($user = User::where('id', auth('user')->id())->first()) {
                $user->update([
                    'last_login_time' => now(),
                    'last_login_device' => request()->userAgent() ?: 'Unknown',
                ]);
                auth('user')->logout();
            }

            auth('admin')->logout();
            auth('master')->logout();

            DB::commit();

            return view('auth.logout', ['title' => 'Logged Out']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Logout failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during logout. Please try again.');
        }
    }
}
