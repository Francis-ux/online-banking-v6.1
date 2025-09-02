<?php

namespace App\Http\Requests;

use App\Rules\AgeAbove18;
use App\Rules\ValidRegistrationToken;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisteredUserControllerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'registration_token' => ['required', new ValidRegistrationToken],
            'dob' => ['required', 'date', new AgeAbove18],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'marital_status' => ['required', 'string', 'in:single,married,separated,divorced,widowed'],
            'dial_code' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'professional_status' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'account_type' => ['required', 'string', 'in:savings,current,corporate'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
