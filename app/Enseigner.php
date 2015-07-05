<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseigner extends Model
{
    protected $table = 'enseigner';
    protected $fillable = ['ue_id', 'user_id'];

    public function ue()
    {
        return $this->belongsTo('App\Ue'); // this matches the Eloquent model
    }

    public function user()
    {
        return $this->belongsTo('App\User'); // this matches the Eloquent model
    }
}
