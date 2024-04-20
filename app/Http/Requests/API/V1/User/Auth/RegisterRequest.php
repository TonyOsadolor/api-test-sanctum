<?php

namespace App\Http\Requests\API\V1\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
