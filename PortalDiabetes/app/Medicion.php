<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    //
    protected $fillable = [
        'glucose', 'fecha', 'longActingInsulin','rapidActingInsulin','rations',
    ];
    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
