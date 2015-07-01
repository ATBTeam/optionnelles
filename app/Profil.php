<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';
    protected $fillable = array('intitule');

    public function users() {
        return $this->hasMany('User'); // this matches the Eloquent model
    }
}
