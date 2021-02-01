<?php

namespace App\Http\Requests;

use App\Models\Settings;
use Illuminate\Foundation\Http\FormRequest;

class SettingsExtraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $settings = Settings::find($this->route('setting'));
        return $this->user()->id == $settings->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
