<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegisteredUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('user')->user();

        if ($user->email_verified_at == null) {
            return redirect()->route('user.email.verification.index')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration.');
        }

        return $next($request);
    }
}
