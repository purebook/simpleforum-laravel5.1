<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body','user_id','discussion_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');//discussion->user();
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class,'discussion_id');//discussion->user();
    }
}
