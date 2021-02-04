<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'song' => ['integer', 'nullable'],
            'exception' => ['boolean'],
            'talk_id' => ['exclude_if:exception,true', 'required', 'integer', 'exists:talks,id'],
            'speaker_id' => ['exclude_if:exception,true', 'required', 'integer', 'exists:speakers,id'],
            'chairman_id' => ['required', 'integer', 'exists:chairmen,id'],
            'custom_talk' => ['exclude_unless:exception,true', 'required', 'string', 'max:255'],
            'custom_speaker' => ['exclude_unless:exception,true', 'required', 'string', 'max:255']
        ];
    }
}
