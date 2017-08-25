<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable =['title','body','user_id','last_user_id',];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');//discussion->user();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);//$user->discussions();
    }
}
