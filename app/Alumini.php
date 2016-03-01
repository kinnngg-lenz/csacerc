<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumini extends Model
{
    protected $fillable = [
        'speech', 'speaker', 'batch', 'profession', 'slug', 'photo_id', 'organisation_id', 'email', 'facebook'
    ];

    protected $hidden = [
        'user_id'
    ];

    /**
     * Return submitter or this Alumini
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Like of this Alumini
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo('App\Organisation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
}
