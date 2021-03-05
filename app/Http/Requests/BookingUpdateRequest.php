<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->settings->id == $this->route('booking')->settings_id;
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
            'settings_id' => ['required', 'integer', 'exists:settings,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'song' => ['integer', 'nullable'],
            'exception' => ['boolean'],
            'no_meeting' => ['boolean'],
            
            'talk_id' => ['exclude_if:exception,true', 'exclude_if:no_meeting,true', 'required', 'integer', 'exists:talks,id'],
            'speaker_id' => ['exclude_if:exception,true', 'exclude_if:no_meeting,true', 'exclude_if:no_meeting,true', 'required', 'integer', 'exists:speakers,id'],
            'chairman_id' => ['nullable', 'integer', 'exists:chairmen,id'],

            // comments only if no_meeting
            'comments' => ['required_if:no_meeting,true', 'string', 'nullable', 'max:255'],
            
            // custom_talk and custom_speaker only if exception
            'custom_talk' => ['exclude_unless:exception,true', 'required', 'string', 'max:255'],
            'custom_speaker' => ['exclude_unless:exception,true', 'required', 'string', 'max:255']
        ];
    }
}
