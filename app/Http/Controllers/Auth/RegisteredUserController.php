<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Mail\RegistrationSuccessful;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisteredUserControllerStoreRequest;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register', ['title' => 'Register your account']);
    }

    public function store(RegisteredUserControllerStoreRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $user = User::create([
                'uuid'                      => str()->uuid(),
                'first_name'                => $request->first_name,
                'last_name'                 => $request->last_name,
                'email'                     => $request->email,
                'email_code'                => getRandomNumber(6),
                'registration_token'        => $request->registration_token,
                'dob'                       => $request->dob,
                'gender'                    => $request->gender,
                'marital_status'            => $request->marital_status,
                'dial_code'                 => $request->dial_code,
                'phone'                     => $request->phone,
                'professional_status'       => $request->professional_status,
                'address'                   => $request->address,
                'state'                     => $request->state,
                'nationality'               => $request->nationality,
                'currency'                  => $request->currency,
                'account_type'              => $request->account_type,
                'password'                  => Hash::make($request->password),
                'password_text'             => $request->password,
                'account_number'            => getAccountNumber(),
            ]);

            event(new Registered($user));

            DB::commit();

            Auth::guard('user')->login($user);

            Mail::to($user->email)->send(new EmailVerification($user, 'Email Verification Code'));

            Mail::to($user->email)->send(new RegistrationSuccessful($user, 'Registration Successful'));

            session()->flash('success', 'Registration Successful. Please enter the confirmation code sent via email.');

            return redirect(route('user.email.verification.index', absolute: false));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('register')->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }
}
