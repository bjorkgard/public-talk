<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeakerStoreRequest extends FormRequest
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
            'settings_id' => ['required', 'integer', 'exists:settings,id'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'congregation' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'max:255', 'nullable'],
            'email' => ['email', 'max:255', 'nullable'],
            'comments' => ['string', 'max:255', 'nullable']
        ];
    }
}
