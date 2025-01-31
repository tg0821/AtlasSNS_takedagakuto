<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function follow($user){
         if (auth()->id() === $user) {
            return back()->with('error', '自分をフォローすることはできません。');
        }

        auth()->user()->follow($user);
        return back()->with('success', 'フォローしました！');
        // return view('follows.followList');
    }
    public function unfollow($user){
        // return view('follows.followerList');
        auth()->user()->unfollow($user);
        return back()->with('success', 'フォロー解除しました！');
    }
}
