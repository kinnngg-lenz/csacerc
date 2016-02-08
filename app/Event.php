<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'date', 'description', 'venue', 'photo_id'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'date'
    ];

    /**
     * Return the Photo related to current Event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}