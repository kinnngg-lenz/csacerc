<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CodeWarQuestion extends Model
{
    protected $fillable = [
        'title', 'description', 'slug', 'ends_at','best_answer_id'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'ends_at'
    ];

    /**
     * All answers of this Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\CodeWarAnswer');
    }

    /**
     * Best answer of this Code War
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bestAnswer()
    {
        return $this->belongsTo('App\CodeWarAnswer','best_answer_id');
    }

    /**
     * The one who started
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Is this codewar still answerable
     *
     * @return bool
     */
    public function isOpen()
    {
        if(is_null($this->ends_at))
            return true;

        return $this->ends_at > Carbon::now();
    }

    /**
     * Likes
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
