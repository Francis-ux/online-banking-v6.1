<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTransactionControllerStoreRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'min:0.01'], // must be a valid number > 0
            'type' => ['required', 'in:deposit,withdrawal,transfer,payment'], // matches your schema enum
            'direction' => ['required', 'in:credit,debit'], // only credit or debit
            'transaction_at' => ['required'],
            'description' => ['nullable', 'string', 'max:255'], // optional text
            'notification' => ['required', 'in:none,email'], // select option
        ];
    }
}
