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
            'confirmation_mail' => 'required|boolean',
            'confirmation_sms' => 'required|boolean',
            'reminder_mail' => 'required|boolean',
            'reminder_sms' => 'required|boolean',
            'thanks_mail' => 'required|boolean',
            'thanks_sms' => 'required|boolean',
            'chairman_mail' => 'required|boolean',
            'chairman_sms' => 'required|boolean',
        ];
    }
}
