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

    public function question()
    {
        return $this->belongsTo('App\CodeWarQuestion', 'code_war_question_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
