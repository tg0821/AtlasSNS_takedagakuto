<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades;


class ProfileController extends Controller
{   //プロフィール編集画面に行くためのメソッド
    public function profile(){
        return view('profiles.profile');
    }

    // プロフィール編集用のメソッド
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'username' => 'required|string|min:2|max:12|unique:users,username',
        'email' => [
            'required',
            'email',
            'min:5',
            'max:40',
            Rule::unique('users', 'email')->ignore($user->id), // 自分のメールアドレスを除外
        ],
        'password' => 'required|min:8|max:20|confirmed',
        'bio' => 'nullable|string|max:150',
        'icon' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg',
    ]);

    $user->username = $request->username;
    $user->email = $request->email;
    // $user->bio = $request->bio;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('icon')) {
        $iconPath = $request->file('icon')->store('icons', 'public');
        $user->icon = basename($iconPath);
    }

    $user->save();

    // return redirect()->route('profile')->with('success', 'プロフィールを更新しました');
    return redirect('top');
}
}
