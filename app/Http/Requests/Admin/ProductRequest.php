<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->input('id');
        return [
            'brand_id' => 'required',
            'name' => 'required',
            // 'excellent_offer' => 'required_unless:device_type,!=,Sell',
            // 'good_offer' => 'required_unless:device_type,!=,Sell',
            // 'fair_offer' => 'required_unless:device_type,!=,Sell',
            // 'poor_offer' => 'required_unless:device_type,!=,Sell',
            // 'storage' => 'required',
            'height' => 'required',
            'width' => 'required',
            'length' => 'required',
            'weight' => 'required',
            'photo' => 'required',
            // 'network' => 'required',
            // 'amount' => 'required_unless:device_type,!=,Buy'
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Brand name is a required field.',
            'name.required' => 'Model is a required field.',
            'excellent_offer.required_unless' => 'This field is required.',
            'good_offer.required_unless' => 'This field is required.',
            'fair_offer.required_unless' => 'This field is required.',
            'poor_offer.required_unless' => 'This field is required.',
            'amount.required_unless' => 'This field is required.',
            'photo.required' => 'Device Photo is required.'
        ];
    }
}
