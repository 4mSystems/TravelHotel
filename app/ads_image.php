<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ads_image extends Model
{
    protected $fillable = ['image', 'ads_id', 'provider_id'];

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/ads_images') . '/' . $img;
        else
            return "";
    }

    public function getUser()
    {

        return $this->hasOne('App\User', 'id', 'provider_id');

    }
    public function ads()
    {

        return $this->hasOne('App\ad', 'id', 'ads_id');

    }
}
