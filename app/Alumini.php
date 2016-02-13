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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
