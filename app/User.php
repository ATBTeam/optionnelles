<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prenom', 'nom', 'mail', 'mdp', 'login'];

    protected $hidden = ['mdp', 'remember_token'];

    public function choixes() {
        return $this->hasMany('App\Choix'); // this matches the Eloquent model
    }

    public function profil()
    {
        return $this->belongsTo('App\Profil'); // this matches the Eloquent model
    }

    public function groupe()
    {
        return $this->belongsTo('App\Groupe'); // this matches the Eloquent model
    }

    public function parcours()
    {
        return $this->belongsTo('App\Parcours'); // this matches the Eloquent model
    }

    public function uesEnseignees(){
        return $this->belongsToMany('\App\Ue', 'Enseigner')->withTimestamps();
    }
}
