<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingControllerUpdateRequest extends FormRequest
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
            'loan_interest_rate' => 'required|numeric',
            'virtual_card_fee' => 'required|numeric',
            'physical_card_fee' => 'required|numeric',
        ];
    }
}
