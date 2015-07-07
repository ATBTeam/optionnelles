<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{

    protected $table = 'choix';
    protected $fillable = ['user_id', 'ue_id', 'parcours_ue_id', 'date_choix'];

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
    
    public function scopeParParcours($query, $parcours_Id){
        return $query->where('parcours_id', $parcours_Id);
    }

    public function scopeParUser($query, $user_Id){
        return $query->where('user_id', $user_Id);
    }

    public function scopeParUe($query, $ue_Id){
        return $query->where('ue_id', $ue_Id);
    }
}
