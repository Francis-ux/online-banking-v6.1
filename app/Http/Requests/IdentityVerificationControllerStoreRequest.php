<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentityVerificationControllerStoreRequest extends FormRequest
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
            'id_front' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // max 2MB
            'id_back'  => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
