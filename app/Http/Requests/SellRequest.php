<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'fname'     => 'required',
            'lname'     => 'required',
            'email'     => 'required|email|unique:customers,email',
            'address1'  => 'required',
            'city'      => 'required',
            'state_id'  => 'required',
            'zip_code'  => 'required',
            'phone'     => 'required',
            'payment_method' => 'required',
            'account_username'  => 'required_unless:payment_method,!=,Bank Transfer',
            'bank'      => 'required_if:payment_method,==,Bank Transfer',
            'account_name' => 'required_if:payment_method,==,Bank Transfer',
            'account_number' => 'required_if:payment_method,==,Bank Transfer'
        ];
    }

    public function messages()
    {
        return [
            'fname.required'            => 'The first name field is required.',
            'lname.required'            => 'The last name field is required.',
            'address1.required'         => 'The address field is required.',
            'state_id.required'         => 'The state field is required.',
            'payment_method.required'   => 'The payment method field is required.',
            'account_username.required_unless'  => 'This field is required.',
            'bank.required_if'      => 'Name of bank is a required field.',
            'account_name.required_if' => 'Account name is a required field.',
            'account_number.required_if' => 'Account number is a required field.'
        ];
    }
}
