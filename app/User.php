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
        'name', 'email', 'password','username','gender','type','about','dob', 'college_id', 'department_id', 'photo_id', 'batch', 'register_time_ip',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','role','dob','banned','approved','type'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'dob'
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

    public function codeWarAnswers()
    {
        return $this->hasMany('App\CodeWarAnswer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college()
    {
        return $this->belongsTo('App\College');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organisations()
    {
        return $this->hasMany('App\Organisation');
    }

    /**
     * Messages Sent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Message', 'sender_id', 'id');
    }

    /**
     * Messages Received
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedMessages()
    {
        return $this->hasMany('App\Message', 'receiver_id', 'id');
    }

    /**
     * If this user has extra role than regular member
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role > 0 && $this->role <= 4;
    }

    /**
     * If this User is Super Admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role >= 3 && $this->role <= 4;
    }

    /**
     * List of all questions ASKED TO THIS USER by others.
     *
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
     * All QUESTIONS ASKED TO THIS USER and STILL NOT ANSWERED.
     *
     * @param bool|false $withGlobal
     * @return mixed
     */
    public function notAnsweredQuestions($withGlobal=false)
    {
        return $this->askedQuestions($withGlobal)->unanswered();
    }

    /**
     * Returns RANK of current User in String
     *
     * @return string
     */
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
            case 4:
                return "Super Administrator";
            default:
                return "Member";
        }
    }

    /**
     * Returns Type of User in String.
     * Get Type Attribute
     *
     * @return string
     */
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

    /**
     * Returns College of User in string.
     * Get College Attribute
     *
     * @return string
     */
    public function gca()
    {
        return $this->college->name;
    }

    /**
     * Returns department in String
     * Get Department Attribute
     *
     * @return string
     */
    public function gda()
    {
        return $this->department->name;
    }

    /**
     * Returns all like this User has made.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /**
     * Return all notes submitted by this User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    /**
     * @return string
     */
    public function getGravatarId()
    {
        return md5($this->email);
    }

    /**
     * @return mixed
     */
    public function getProfilePicUrl()
    {
        if(is_null($this->photo))
        {
            if($this->gender == "Male")
                return "Male.jpeg";
            else
                return "Female.jpeg";
        }
        return $this->photo->url;
    }

    /**
     * @param $username
     * @return mixed
     */
    public static function findOrFailByUsername($username)
    {
        $user = static::whereUsername($username)->first();

        if(is_null($user))
            abort(404);
        else
            return $user;
    }

    /**
     * Returns all messages of this user sent by provided username
     *
     * @param $username
     * @return mixed
     */
    public function messagesBy($username)
    {
        $by = static::findOrFailByUsername($username);
        $messages = $this->receivedMessages()->where('sender_id',$by->id);
        return $messages;
    }


    /**
     * Returns all messages of this user sent by provided username and also Unseen
     *
     * @param $username
     * @return mixed
     */
    public function messagesUnseenBy($username)
    {
        $by = static::findOrFailByUsername($username);
        $messages = $this->receivedMessages()->where('sender_id',$by->id)->whereSeenAt(null);
        return $messages;
    }

    /**
     * All messages that are received and also not seen
     *
     * @return mixed
     */
    public function receivedMessagesUnseen()
    {
        return $this->receivedMessages()->whereSeenAt(null);
    }

    /**
     * Collection of all message either send or received by this user
     *
     * @return mixed
     */
    public function allMessages()
    {
        return Message::where('sender_id',$this->id)->orWhere('receiver_id',$this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shouts()
    {
        return $this->hasMany('App\Shout');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereBanned(0);
    }

}
