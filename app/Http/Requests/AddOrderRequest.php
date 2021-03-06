<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddOrderRequest extends Request
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
            //'order_number'=>'required|unique:jobs|min:10|max:11',
            'contact_id' => 'exists:contacts,id',
            'job.option.*.accepted'=>'required|in:on,1,true',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'order_number'=>'required|unique:jobs|min:10|max:11',
            'contact_id.exists'=>'Please select a contact from the company',
        ];
    }
}
