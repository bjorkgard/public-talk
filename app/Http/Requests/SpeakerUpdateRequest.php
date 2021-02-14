<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeakerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->settings->id == $this->route('speaker')->settings_id;
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
            'phone' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'comments' => ['max:255']
        ];
    }
}
