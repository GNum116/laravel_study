<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ResetPassword;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    static public function boot()
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

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function feed()
    {
        // return $this->statuses()->orderBy('created_at', 'DESC');
        $userIds = Auth::user()->followings->pluck('id')->toArray();
        array_push($userIds, Auth::user()->id);

        return Status::whereIn('user_id', $userIds)->with('user')->orderBy('created_at', 'DESC');
    }

    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($userIds)
    {
        if (!is_array($userIds)) {
            $userIds = compact('userIds');
        }
        $this->followings()->sync($userIds, false);
    }

    public function unfollow($userIds)
    {
        if (!is_array($userIds)) {
            $userIds = compact('userIds');
        }
        $this->followings()->detach($userIds);
    }

    public function isFollowing($userId)
    {
        return $this->followings->contains($userId);
    }
}
