<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'tool_id' => 'required|numeric',
            'cost_centre_id' => 'sometimes|required|numeric',
            'cost_centre' => 'sometimes|required|numeric',
            'description' => 'sometimes|string|nullable',
            'user_limit' => 'numeric|nullable',
            'users_current' => 'numeric|lte:user_limit|nullable',
            'annual_cost' => 'numeric|nullable',
            'currency' => 'sometimes|required|alpha|nullable|max:3',
            'cost_per_user' => 'numeric|nullable',
            'start' => 'sometimes|required|date|nullable',
            'stop' => 'sometimes|required|date|nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'users_current.lte' => 'Please make sure the current users number is no larger than the maximum available for this licence.'
        ];
    }
}
