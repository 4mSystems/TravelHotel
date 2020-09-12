<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ad extends Model
{
    protected $fillable = ['name', 'image', 'description', 'phone'
        , 'address', 'status', 'start_at', 'end_at'
        , 'provider_id', 'category_id','title'
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
