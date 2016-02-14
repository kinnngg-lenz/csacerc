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
        'name', 'email', 'password','username','gender','type','about','dob', 'college', 'department'
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


    public function gta()
    {
        switch($this->type)
        {
            case 0:
                return "Student";
            case 1:
                return "Faculty Member";
            default:
                return "Student";
        }
    }

    public function gca()
    {
        switch($this->college)
        {
            case 0:
                return "None";
            case 1:
                return "ARYA College of Engg & Research Center";
            case 2:
                return "ARYA Institute of Engg & Technology";
            case 3:
                return "ARYA Institute of Engg Tech & Management";
            case 4:
                return "ARYA College of Pharmacy";
            case 5:
                return "Old ARYA";
            case 6:
                return "Others";
            default:
                return "None";
        }
    }


    public function gda()
    {
        switch($this->department)
        {
            case 0:
                return "None";
            case 1:
                return "Department of Computer Science Engineering";
            case 2:
                return "Department for 1st Year";
            case 3:
                return "Department of Civil Engineering";
            case 4:
                return "Department of Electrical Engineering";
            case 5:
                return "Department of Mechanical Engineering";
            case 6:
                return "Others";
            default:
                return "None";
        }
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
