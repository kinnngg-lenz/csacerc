<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'name', 'department_id', 'college_id', 'owner', 'user_id', 'slug', 'url', 'semester',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function getSemesterAttribute($sem)
    {
        switch($sem)
        {
            case 0:
                return "All Semester";
                break;
            case 1:
                return "First Semester";
                break;
            case 2:
                return "Second Semester";
                break;
            case 3:
                return "Third Semester";
                break;
            case 4:
                return "Forth Semester";
                break;
            case 5:
                return "Fifth Semester";
                break;
            case 6:
                return "Sixth Semester";
                break;
            case 7:
                return "Seventh Semester";
                break;
            case 8:
                return "Eighth Semester";
                break;
            default:
                return "Any Semester";
        }
    }
}
