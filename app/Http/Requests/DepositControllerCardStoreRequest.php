<?php

namespace App\Http\Requests;

use App\Rules\ValidCardDate;
use Illuminate\Foundation\Http\FormRequest;

class DepositControllerCardStoreRequest extends FormRequest
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
            'method' => 'required|in:card',
            'card_number' => 'required|numeric|max_digits:16|min_digits:16',
            'cvv' => 'required|numeric|max_digits:3|min_digits:3',
            'card_expiry_date' => ['required', new ValidCardDate()],
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

            'card_number.required' => 'The card number is required.',
            'card_number.numeric' => 'The card number must contain only digits.',
            'card_number.max_digits' => 'The card number must be exactly 16 digits.',
            'card_number.min_digits' => 'The card number must be exactly 16 digits.',

            'cvv.required' => 'The CVV code is required.',
            'cvv.numeric' => 'The CVV code must contain only digits.',
            'cvv.max_digits' => 'The CVV code must be 3 digits.',
            'cvv.min_digits' => 'The CVV code must be 3 digits.',

            'card_expiry_date.required' => 'The card expiry date is required.',
            'card_expiry_date.valid_card_expiry_date' => 'The card expiry date must be a valid MM/YY format and not expired.',
        ];
    }
}
