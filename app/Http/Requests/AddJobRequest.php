<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddJobRequest extends FormRequest
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
            'name'=>'required|min:5|max:255',
            'distance'=>'required',
            'address'=>'required',
            // 'suburb'=>'required_without:is_estate',
            'city'=>'required_without:is_estate',
            'country'=>'required',
            'company_id'=>'required_without:company_address1',
            'contact'=>'required_without:new_contact',
            'company_name'=>'required_without:company_id',
            'company_address1'=>'required_without:company_id',
            'company_address2'=>'required_without:company_id',
            'new_contact.*.first_name'=>'required_without:contact|bail',
            'new_contact.*.last_name'=>'required_without:contact',
            'new_contact.*.email'=>'required_without:contact',
            'new_contact.*.contact1'=>'required_without:contact',
            'value'=>'required_with:custom',
            'categories'=>'required_with:custom',
            'quote'=>'required_with:custom',
        ];
    }
}
