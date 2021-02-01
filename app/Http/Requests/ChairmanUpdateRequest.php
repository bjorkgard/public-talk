<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChairmanUpdateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->errorBag = 'chairmanErrorBag';
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id == $this->route('chairman')->user_id;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
