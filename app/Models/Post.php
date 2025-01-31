<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post', 'user_id', // 必要なカラムを追加
        // 他のカラム名もここに追加
    ];

    // 投稿を取得するためのリレーション
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
