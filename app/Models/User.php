<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://s.gravatar.com/avatar/$hash?s=$size";
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function avatar($size = '100')
    {
        return empty($this->attributes['avatar']) ? $this->gravatar($size) : $this->attributes['avatar'];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
