<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<string>|string>
     */
    public function rules(): array
    {
        return [
            'tenant_name'   => ['required', 'string'],
            'tenant_domain' => ['required', 'string'],
            'tenant_slug'   => ['required', 'string'],
            'tenant_tax_id' => ['required', 'string'],
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email'],
            'password'      => ['required', 'string'],
        ];
    }
}
