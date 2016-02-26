<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'url', 'gallery'
    ];

    /*
     * Doing this may cause problem becoz its not a polymorphic.
     * If you wanna leverage this feature then plz use a polymorphic table for Photo.
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

    public function scopeGallery($query)
    {
        $query->whereGallery(1);
    }

    public function getGallery()
    {
        return $this->gallery();
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

}
