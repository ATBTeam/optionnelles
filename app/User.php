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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    private $id_profil;
    private $id_groupe;
    private $id_parcours;
    private $actif;

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getIdParcours()
    {
        return $this->id_parcours;
    }

    /**
     * @param mixed $id_parcours
     */
    public function setIdParcours($id_parcours)
    {
        $this->id_parcours = $id_parcours;
    }

    /**
     * @return mixed
     */
    public function getIdGroupe()
    {
        return $this->id_groupe;
    }

    /**
     * @param mixed $id_groupe
     */
    public function setIdGroupe($id_groupe)
    {
        $this->id_groupe = $id_groupe;
    }

    /**
     * @return array
     */
    public function getIdProfil()
    {
        return $this->id_profil;
    }

    /**
     * @param array $id_profil
     */
    public function setIdProfil($id_profil)
    {
        $this->id_profil = $id_profil;
    }




    protected $hidden = ['mdp', 'remember_token'];

    public function choixes() {
        return $this->hasMany('Choix'); // this matches the Eloquent model
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
}
