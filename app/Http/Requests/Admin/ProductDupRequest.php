<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductDupRequest extends FormRequest
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
            'excellent_offer' => 'required',
            'good_offer' => 'required',
            'fair_offer' => 'required',
            'poor_offer' => 'required',
            'storage' => 'required',
            'network' => 'required'
        ];
    }
}
