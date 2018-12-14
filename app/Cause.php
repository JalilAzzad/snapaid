<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{

    /**
     * The causes that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'cause_user', 'user_id', 'cause_id')->withTimestamps();
    }


    /**
     * Get the post that owns the comment.
     */
    public function category()
    {
        return $this->belongsTo('App\CausesCategory', 'category_id');
    }


    /**
     * Get the reports for the cause.
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }
}
