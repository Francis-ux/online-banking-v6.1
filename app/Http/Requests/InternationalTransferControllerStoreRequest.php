<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternationalTransferControllerStoreRequest extends FormRequest
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
            'account_number' => ['required', 'numeric'],
            'account_name' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'swift_code' => ['nullable', 'string'],
            'iban_code' => ['nullable', 'string'],
            'routing_number' => ['nullable', 'string'],
            'amount' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
            'transfer_pin' => ['required', 'numeric'],
        ];
    }
}
