<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','gender','type','about','dob',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','role',
    ];

    public function aluminis()
    {
        return $this->hasMany('App\Alumini');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function news()
    {
        return $this->hasMany('App\News');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function isAdmin()
    {
        return $this->role > 0;
    }

    public function askedQuestions()
    {
        return \App\Question::whereForUserId($this->id);
    }

    public function notAnsweredQuestions()
    {
        return $this->askedQuestions()->unanswered();
    }
}
