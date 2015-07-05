<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ParcoursRequest extends Request
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
            //
            'intitule'    => 'required|min:1|max:50',
            'description' => 'required|max:500',
            'annee'       => 'required|min:1|max:10\numeric',
            'nb_opt_s1'   => 'required|min:1|max:10|numeric',
            //'deb_choix_s1'=> 'required',
            //'fin_choix_s1'=> 'required',
            'nb_opt_s2'   => 'required|min:1|max:10|numeric',
            //'deb_choix_s2'=> 'required',
            //'fin_choix_s2'=> 'required',

        ];
    }
}
