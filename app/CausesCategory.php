<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CausesCategory extends Model
{

    /**
     * Get the causes for the category.
     */
    public function causes()
    {
        return $this->hasMany('App\Cause', 'category_id');
    }
}
