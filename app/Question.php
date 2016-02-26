<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'for_user_id', 'slug', 'public'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    /**
     * @return \stdClass
     */
    public function askedTo()
    {
        if(is_null($this->for_user_id))
        {
            $user = new \stdClass();
            $user->name = null;
        }
        else
        $user = \App\User::find($this->for_user_id);

        return $user;
    }

    /**
     * @param $query
     */
    public function scopePublic($query)
    {
        $query->wherePublic(1);
    }

    /**
     * @param $query
     */
    public function scopeApproved($query)
    {
        $query->whereApproved(1);
    }

    /**
     * @param $query
     */
    public function scopePending($query)
    {
        $query->whereApproved(0);
    }

    /**
     * @param $query
     */
    public function scopeUnanswered($query)
    {
        $query->whereAnswer(null);
    }

    /**
     * @param $query
     */
    public function scopeGlobal($query)
    {
        $query->whereForUserId(null);
    }
}
