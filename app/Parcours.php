<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcours extends Model
{
    protected $table = 'parcours';
    protected $fillable = ['intitule', 'description', 'annee', 'nb_opt_s1', 'nb_opt_s2', 'deb_choix_s1', 'fin_choix_s1', 'deb_choix_s1', 'fin_choix_s2', 'specialite_id'];

    public function users() {
        return $this->hasMany('App\User'); // this matches the Eloquent model
    }

    public function groupes() {
        return $this->hasMany('App\Groupe'); // this matches the Eloquent model
    }

    public function specialite()
    {
        return $this->belongsTo('App\Specialite'); // this matches the Eloquent model
    }
}
