<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
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
      'username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*****
     Relationships
    *****/
    public function battleplans() {
      return $this->hasMany('App\Models\Battleplan', 'user_id');
    }

    public function room() {
      return $this->hasMany('App\Models\Room', 'owner');
    }
    public function isAdmin(){
      return $this->id == 1;
    }
}
