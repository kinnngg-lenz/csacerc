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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aluminis()
    {
        return $this->hasMany('App\Alumini');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany('App\News');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codeWarQuestions()
    {
        return $this->hasMany('App\CodeWarQuestion');
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role > 0;
    }

    /**
     * @param bool|false $withGlobal
     * @return mixed
     */
    public function askedQuestions($withGlobal=false)
    {
        if($withGlobal == false)
            return \App\Question::whereForUserId($this->id);
        else
            return \App\Question::whereForUserId($this->id)->orWhere('for_user_id',null);
    }

    /**
     * @param bool|false $withGlobal
     * @return mixed
     */
    public function notAnsweredQuestions($withGlobal=false)
    {
        return $this->askedQuestions($withGlobal)->unanswered();
    }

    public function rank()
    {
        switch($this->role)
        {
            case 0:
                return "Member";
            case 1:
                return "Moderator";
            case 2:
                return "Administrator";
            case 3:
                return "Super Administrator";
            default:
                return "Member";
        }
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
