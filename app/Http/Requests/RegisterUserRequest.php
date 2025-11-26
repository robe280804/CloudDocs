<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                // Solo lettere, spazi e apostrofi 
                'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\'\s]+$/u'
            ],

            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:12',
                'max:64',
                // Deve contenere almeno una maiuscola, minuscola, numero e simbolo
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                'confirmed',        // Richiede password_confirmation
            ],
        ];
    }
}
