<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'icon_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * ユーザーのフォロワーを取得するリレーション
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    /**
     * ユーザーがフォローしているユーザーを取得するリレーション
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    /**
     * 特定のユーザーをフォローする
     */
    public function follow($user)
    {
        if (!$this->isFollowing($user)) {
            $this->following()->attach($user);
        }
    }

    /**
     * 特定のユーザーのフォローを解除する
     */
    public function unfollow($user)
    {
        if ($this->isFollowing($user)) {
            $this->following()->detach($user);
        }
    }

    /**
     * 指定したユーザーをフォローしているか確認する
     */
    public function isFollowing($user): bool
    {
        return $this->following()->where('followed_id', $user)->exists();
    }

    /**
     * 指定したユーザーにフォローされているか確認する
     */
    public function isFollowedBy($user): bool
    {
        return $this->followers()->where('following_id', $user)->exists();
    }

    // 投稿を取得するためのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
