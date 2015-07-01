<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    protected $table = 'specialite';
    protected $fillable = ['intitule', 'description'];

    public function parcours() {
        return $this->hasMany('Parcours'); // this matches the Eloquent model
    }
}
