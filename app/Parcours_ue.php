<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcours_ue extends Model
{
    protected $table = 'parcours_ue';
    protected $fillable = ['id_parcours', 'id_ue', 'nbmin', 'nb_max', 'est_optionnel'];

    public function choixes() {
        return $this->hasMany('Choix'); // this matches the Eloquent model
    }

    public function parcours()
    {
        return $this->belongsTo('App\Parcours'); // this matches the Eloquent model
    }

    public function ue()
    {
        return $this->belongsTo('App\Ue'); // this matches the Eloquent model
    }
}
