<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginVerificationControllerStoreRequest extends FormRequest
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
            'code'   => ['required', 'array', 'size:6'],      // Must be an array of exactly 6 items
            'code.*' => ['required', 'digits:1'],             // Each item must be a single digit (0–9)
        ];
    }

    public function messages(): array
    {
        return [
            'code.required'   => 'The code field is required.',
            'code.array'      => 'The code field must be an array.',
            'code.size'       => 'The code field must contain exactly 6 items.',
            'code.*.required' => 'Each item in the code field is required.',
            'code.*.digits'   => 'Each item in the code field must be a single digit (0–9).',
        ];
    }
}
