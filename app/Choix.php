<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//php artisan make:model User --migration => Créer Model + class de migration
class Choix extends Model
{
    protected $table = 'choix';
    protected $fillable = ['id_user', 'id_ue', 'id_parcours', 'date_choix'];

    public function user()
    {
        return $this->belongsTo('App\User'); // this matches the Eloquent model
    }

    public function ue()
    {
        return $this->belongsTo('App\Ue'); // this matches the Eloquent model
    }

    public function parcours()
    {
        return $this->belongsTo('App\Parcours'); // this matches the Eloquent model
    }
}
