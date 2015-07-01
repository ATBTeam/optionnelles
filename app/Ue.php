<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ue extends Model
{
    protected $table = 'ue';
    protected $fillable = ['intitule', 'description', 'semestre'];

    public function parcours_ues() {
        return $this->hasMany('Parcours_UE'); // this matches the Eloquent model
    }

    public function enseigners() {
        return $this->hasMany('Enseigner'); // this matches the Eloquent model
    }
}
