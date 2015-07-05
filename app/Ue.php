<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ue extends Model
{
    protected $table = 'ue';
    protected $fillable = ['intitule', 'description', 'semestre'];

    public function parcours_ues() {
        return $this->hasMany('Parcours_ue'); // this matches the Eloquent model
    }

    public function enseignants() {
        return $this->belongsToMany('\App\User', 'Enseigner')->withTimestamps(); // this matches the Eloquent model
    }
}
