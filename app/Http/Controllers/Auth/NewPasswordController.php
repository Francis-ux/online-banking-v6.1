<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPasswordControllerStoreRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        $data = [
            'title' => 'Reset Password',
            'request' => $request,
        ];

        return view('auth.reset_password', $data);
    }

    public function store(NewPasswordControllerStoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            // Find user by email
            $user = User::where('email', $validated['email'])->first();
            if (!$user) {
                DB::rollBack();
                return redirect()->route('login')->with('error', 'User not found');
            }

            // Find and validate password reset token
            $passwordResetToken = PasswordResetToken::where('email', $validated['email'])
                ->where('token', $validated['token'])
                ->first();

            if (!$passwordResetToken) {
                DB::rollBack();
                return redirect()->route('login')->with('error', 'Invalid or expired token');
            }

            // Check token expiration (assuming a 'created_at' or 'expires_at' column exists)
            if (isset($passwordResetToken->created_at) && $passwordResetToken->created_at->addHours(2)->isPast()) {
                DB::rollBack();
                return redirect()->route('login')->with('error', 'Token has expired');
            }

            // Update password
            $user->password = Hash::make($validated['password']);
            $user->save();

            // Delete the used token
            $passwordResetToken->delete();

            DB::commit();

            return redirect()->route('login')->with('success', 'Password changed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Password reset failed: ' . $e->getMessage(), ['email' => $validated['email']]);
            return redirect()->route('login')->with('error', 'An error occurred while resetting the password. Please try again.');
        }
    }
}
