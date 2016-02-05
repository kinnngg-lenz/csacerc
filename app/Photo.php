<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /*
     * Doing this may cause problem becoz its not a polymorphic.
     * If you wanna levarage this feature then plz use a polymorphic table for Photo.
     *
     *   public function news()
     *   {
     *       return $this->belongsTo('App\News');
     *  }
     *
     *   public function event()
     *   {
     *       return $this->belongsTo('App\Event');
     *   }
     */

}
