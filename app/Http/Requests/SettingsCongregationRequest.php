<?php

namespace App\Http\Requests;

use App\Models\Settings;
use Illuminate\Foundation\Http\FormRequest;

class SettingsCongregationRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->errorBag = 'updateCongregationSettings';
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $settings = Settings::find($this->route('setting'));

        return $settings && $this->user()->id == $settings->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ];
    }
}
