<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
