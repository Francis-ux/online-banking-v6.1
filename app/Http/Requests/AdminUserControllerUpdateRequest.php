<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminUserControllerUpdateRequest extends FormRequest
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
        $id = $this->route('id');

        $user = User::where('uuid', $id)->first();

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'dob' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'marital_status' => 'required',
            'dial_code' => 'required',
            'phone' => 'required',
            'professional_status' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'state' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'currency' => 'required',
            'account_type' => 'required',
            'should_login_require_code' => 'required|boolean',
            'should_transfer_fail' => 'required|boolean',
            'transfer_pin' => 'nullable|string|min:4|max:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_front' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'id_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
