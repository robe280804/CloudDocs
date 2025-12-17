<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialDocumentRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],

            'period_start' => ['required', 'date'],
            'period_end'   => ['required', 'date', 'after_or_equal:period_start'],
            'notes' => ['nullable', 'string', 'max:2000'],

            // Entries validation
            'entries' => ['required', 'array', 'min:1'],
            'entries.*.title'       => ['required', 'string', 'max:255'],
            'entries.*.description' => ['nullable', 'string', 'max:2000'],
            'entries.*.date'        => ['required', 'date'],
            'entries.*.amount'      => ['required', 'numeric'],
            'entries.*.type'        => ['required', 'in:income,expense'],
            'entries.*.currency'    => ['required', 'string', 'size:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'entries.required' => 'You must provide at least one entry.',
            'entries.*.title.required' => 'Each entry must have a title.',
            'entries.*.amount.numeric' => 'The amount must be a valid number.',
            'entries.*.type.in' => 'The type must be either "income" or "expense".',
            'entries.*.currency.size' => 'The currency code must be 3 characters long (e.g., USD, EUR).',
        ];
    }
}
