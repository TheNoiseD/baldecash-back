<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'role_id' => 'required,exists:roles,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'lastname.required' => 'Lastname is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'role_id.required' => 'Role is required',
            'role_id.exists' => 'Role does not exist'
        ];
    }
}
