<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumini extends Model
{
    protected $fillable = [
        'speech', 'speaker', 'batch', 'profession', 'slug',
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
}
