<?php

namespace App\Http\Requests;

class SpecialiteRequest extends Request
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
            'nom' => 'required|min:1|max:50',
            'texte' => 'required|max:500'
            //
        ];
    }
}
