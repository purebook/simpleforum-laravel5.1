<?php

namespace App;

use App\Events\UserRegistered;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','avatar','confirm_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function discussions()
    {
        return $this->hasMany(Discussion::class);//$user->discussions();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);//$user->discussions();
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password']=\Hash::make($password);
        
    }

    public static function register(array $attributes)
    {
        $user = static::create($attributes);
        event(new UserRegistered($user));

        return $user;
    }
}
