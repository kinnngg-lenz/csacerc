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

    public function scopePublic($query)
    {
        $query->wherePublic(1);
    }

    public function scopeApproved($query)
    {
        $query->whereApproved(1);
    }

    public function scopePending($query)
    {
        $query->whereApproved(0);
    }

    public function scopeUnanswered($query)
    {
        $query->whereAnswer(null);
    }

    public function scopeGlobal($query)
    {
        $query->whereForUserId(null);
    }


}
