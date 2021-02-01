<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeakerStoreRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->errorBag = 'speakerErrorBag';
    }

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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'congregation' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'max:255', 'nullable'],
            'email' => ['email', 'max:255', 'nullable'],
            'comments' => ['string', 'max:255', 'nullable']
        ];
    }
}
