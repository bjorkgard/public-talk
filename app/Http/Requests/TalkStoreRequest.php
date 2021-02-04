<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalkStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->owner;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => ['required', 'integer', 'unique:talks,number,NULL,id,deleted_at,NULL'],
            'theme' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255']
        ];
    }
}
