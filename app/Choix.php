<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{

    protected $table = 'choix';
    protected $fillable = ['user_id', 'ue_id', 'parcours_id', 'date_choix'];

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
