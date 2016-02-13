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

    public function answers()
    {
        return $this->hasMany('App\CodeWarAnswer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isOpen()
    {
        if(is_null($this->ends_at))
            return true;

        return $this->ends_at > Carbon::now();
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
