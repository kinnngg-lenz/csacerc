<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CodeWarQuestion extends Model
{
    protected $fillable = [
        'title', 'description', 'slug', 'ends_at',
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
}
