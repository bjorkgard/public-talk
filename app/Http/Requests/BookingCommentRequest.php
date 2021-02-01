<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingCommentRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->errorBag = 'commentsErrorBag';
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id == $this->route('booking')->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grade' => ['required', 'integer'],
            'comments' => ['string', 'nullable']
        ];
    }
}
