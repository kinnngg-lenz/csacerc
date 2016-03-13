<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeWarAnswer extends Model
{
    protected $fillable = [
        'answer',
        'user_id',
        'code_war_question_id'
    ];

    /**
     * Question of this answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\CodeWarQuestion', 'code_war_question_id');
    }

    /**
     * The answerer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * All likes on this answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function getAnswerAttribute($data)
    {
        if(substr($data,0,3) == '```')
        return $data;
        else
            return "```\n".$data."\n```";
    }
}
