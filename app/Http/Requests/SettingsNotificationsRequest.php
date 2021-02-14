<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsNotificationsRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->errorBag = 'updateNotificationsSettings';
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->settings->id == $this->route('setting')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'confirmation' => 'required|boolean',
            'reminder' => 'required|boolean',
            'thanks' => 'required|boolean',
            'chairman' => 'required|boolean',
        ];
    }
}
