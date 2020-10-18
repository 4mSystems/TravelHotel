<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ad extends Model
{
    protected $fillable = ['image', 'description',
    'price','status', 'provider_id', 'category_id'
    ];

        public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/ads') . '/' . $img;
        else
            return "";
    }

    public function getUser()
    {

        return $this->hasOne('App\User', 'id', 'provider_id');

    }

    public function category()
    {

        return $this->hasOne('App\Category', 'id', 'category_id');

    }


  
}
