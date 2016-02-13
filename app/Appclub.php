<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appclub extends Model
{
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
