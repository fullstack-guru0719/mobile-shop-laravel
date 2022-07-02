<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "first_name"        => "required|string",
            "last_name"         => "required|string",
            "email"             => "required|email|unique:customers,email,null,id",
            "phone"             => "required",
            "password"          => "required|same:confirm_password",
            "confirm_password"  => "required|same:password",
            "address1"          => "required",
            "address2"          => "nullable",
            "city"              => "required",
            "state_id"          => "required",
            "zip_code"          => "required"
        ];
    }
}
