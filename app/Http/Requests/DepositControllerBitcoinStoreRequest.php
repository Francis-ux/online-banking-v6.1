<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositControllerBitcoinStoreRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:bitcoin',
            'wallet_address' => 'required|string|max:255',
            'proof' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'The deposit amount is required.',
            'amount.numeric' => 'The deposit amount must be a valid number.',
            'amount.min' => 'The deposit amount must be at least :min.',
            'method.required' => 'The payment method is required.',
            'method.in' => 'The selected payment method is invalid.',
            'wallet_address.required' => 'The Bitcoin wallet address is required.',
            'wallet_address.max' => 'The Bitcoin wallet address is too long.',
            'proof.file' => 'The proof must be a valid file.',
            'proof.mimes' => 'The proof must be a JPG, or PNG file.',
            'proof.max' => 'The proof file size must not exceed 2MB.',
        ];
    }
}
