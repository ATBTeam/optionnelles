<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO : gérer les autorisations
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
            'intitule' => 'required|min:5|max:100|string',
            'description' => 'required|min:10|max:500',
            'semestre' => 'required'
        ];
    }
}
