<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'text', 'speaker', 'slug', 'approved',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Select a random quote from DB
     *
     * @return mixed
     */
    public static function random()
    {
        return self::whereApproved(1)->get()->random();
    }

    /**
     * Return random for View
     *
     * @return string
     */
    public static function quote()
    {
        $quote = self::random();

        if(is_null($quote->speaker))
            return $quote->text;

        return $quote->text." - ".$quote->speaker;
    }

    /**
     * @return string
     */
    public static function getQotd()
    {
        if(Cache::has('qotd'))
        {
            $quote = Cache::get('qotd');
            if(is_null($quote->speaker))
                return "<span class='text-lg'>&#8220;</span> $quote->text <span class='text-lg'>&#8221;</span>";
            else
                return "<span class='text-lg'>&#8220;</span> $quote->text <span class='text-lg'>&#8221;</span><br> - $quote->speaker";
        }
        else
        {
            if(\Auth::check() && \Auth::user()->isAdmin())
            {
                return "<span class='text-danger'><i>No Quote set as Quote of the Day and so a random quote will be shown to public.</i></span>";
            }

            $quote = self::random();
            if(is_null($quote->speaker))
                return "<span class='text-lg'>&#8220;</span> $quote->text <span class='text-lg'>&#8221;</span>";
            else
                return "<span class='text-lg'>&#8220;</span> $quote->text <span class='text-lg'>&#8221;</span><br> - $quote->speaker";
        }
    }
}
