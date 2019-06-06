<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Referencia a la clase User
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
