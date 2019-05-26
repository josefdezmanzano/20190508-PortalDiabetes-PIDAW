<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','diabetic','created_at','update_at',//agrego image y diabetic a fillable
    ];

    //Para los tiempos pero no funca sosio
    public $timestamps = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Referencia a la tabla roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    /**
     * Devuelve un error 401 si no concuerda el rol
     */
    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);

        return true;
    }
    /**
     * Comprueba si existe algun rol
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }
    /**
     * Comprubea si tiene un rol
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }


    public function mediciones(){
        return $this->hasMany('App\Medicion');
    }
}
