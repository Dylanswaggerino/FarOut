<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => "string|required|min:2",
            "last_name" => "string|required|min:2",
            "email" => "string|required|email:rfc,dns|unique:users,email",
            "password" => "string|required|min:6",
            "address" => "string|required",
            "postal_code" => "string|required",
            "city" => "string|required",
            "country_code" => "string|required",
            "phone" => "string|required|unique:users,phone",
        ];
    }

    public function attributes()
    {
        return [
            "first_name" => "first name",
            "last_name" => "last name",
            "email" => "email address",
            "postal_code" => "postal code",
            "country_code" => "country code",
            "phone" => "phone number",
        ];
    }

    public function hashPassword()
    {
        $this->password = Hash::make($this->password);
    }
}
