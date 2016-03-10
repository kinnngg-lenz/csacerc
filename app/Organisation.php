<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'name', 'initials', 'details', 'photo_id', 'address', 'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aluminis()
    {
        return $this->hasMany('App\Alumini');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        if(is_null($this->photo_id))
        {
            return "noimage.jpg";
        }
        return $this->photo->url;
    }

}
