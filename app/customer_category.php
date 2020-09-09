<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_category extends Model
{
    protected $fillable = [
        'user_id', 'category_id'
    ];

    public function getUser()
    {

        return $this->belongsTo('App\User', 'id', 'user_id');

    }

    public function category()
    {

        return $this->belongsTo('App\Category', 'id', 'category_id');

    }
}
