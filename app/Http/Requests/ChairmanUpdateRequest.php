<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChairmanUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->settings->id == $this->route('chairman')->settings_id;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_country' => ['required_with:phone'],
            'phone' => ['required', 'phone'],
        ];
    }
}
