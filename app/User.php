<?php

namespace App;

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
        'firstname', 'lastname', 'phone', 'gender', 'email', 'password', 'email_code', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'birth_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The causes that belong to the user.
     */
    public function causes()
    {
        return $this->belongsToMany('App\Cause')->withTimestamps();
    }


    /**
     * Get the reports for the user.
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }
}
