<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['receiver_id', 'message'];

    /**
     * Message Sender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    /**
     * Message Receiver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    /**
     * Return Converstion btw 2 users
     *
     * @param $user1
     * @param $user2
     * @return mixed
     */
    public static function conversation($user1,$user2)
    {
        $conv = static::where(function($q) use($user1,$user2){
            $q->where('sender_id',$user1->id)->where('receiver_id',$user2->id);
        })->orWhere(function($q) use($user1,$user2){
            $q->where('sender_id',$user2->id)->where('receiver_id',$user1->id);
        });
        return $conv;
    }

    public function hasBeenSeen()
    {
        $this->seen_at = Carbon::now();
        $this->save();
    }
}
