<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role)
    {
        $role_entity = Role::where('name', $role)->get();
        $id = null;
        foreach ($role_entity as $object) {
            $id = $object->id;
        }
        $user = User::where('role_id', $id)->get();

        if ($user->isEmpty()) {
            return false;
        }
        return true;
    }
}
