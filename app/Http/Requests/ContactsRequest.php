<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
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
        $contact_id = request()->id;
        return [
            'skip_contact' => 'required_without_all:name,email,slack',
            'name' => 'required_without:skip_contact|unique:contacts,name,'.$contact_id.',id|max:80',
            'email' => 'required_without:skip_contact|email:rfc,dns|unique:contacts,email,'.$contact_id.',id',
            'slack' => 'sometimes|nullable|unique:contacts,slack,'.$contact_id.',id'
        ];
    }
}
