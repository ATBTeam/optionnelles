<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ue extends Model
{
    protected $table = 'ue';
    protected $fillable = ['intitule', 'description', 'semestre'];

    public function parcours_ues() {
        return $this->hasMany('\App\Parcours_ue'); // this matches the Eloquent model
    }

    public function enseignants() {
        return $this->belongsToMany('\App\User', 'Enseigner')->withTimestamps(); // this matches the Eloquent model
    }

    public function parcours() {
        return $this->belongsToMany('\App\Parcours', 'Parcours_ue')->withTimestamps(); // this matches the Eloquent model
    }
}
