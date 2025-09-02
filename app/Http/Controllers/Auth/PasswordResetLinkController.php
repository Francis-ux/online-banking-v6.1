<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PasswordResetLink;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PasswordResetLinkControllerStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot_password', ['title' => 'Forgot Password']);
    }

    public function store(PasswordResetLinkControllerStoreRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                DB::rollBack();
                return back()->withErrors(['email' => 'No user found with this email.']);
            }

            $token = Str::random(64);

            PasswordResetToken::updateOrCreate(
                [
                    'email' => $user->email
                ],
                [
                    'token' => $token,
                    'created_at' => now()
                ]
            );

            $passwordResetToken = PasswordResetToken::where('email', $user->email)->first();

            $passwordResetLink = route('password.reset', ['token' => $passwordResetToken->token, 'email' => $passwordResetToken->email]);

            Mail::to($user->email)->send(new PasswordResetLink($user, $passwordResetLink, 'Password Reset Link'));

            DB::commit();

            return redirect()->back()->with('success', 'Password reset link sent successfully. Please check your email.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Password reset link failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }
}
