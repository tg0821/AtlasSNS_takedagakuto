<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash; //これ追加
use Illuminate\Support\Str;  // Str クラスをインポート

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
        'username' => 'required|string|min:2|max:12',
        'email' => ['required',
            'email',
            'min:5',
            'max:40',
            Rule::unique('users', 'email')->ignore($user->id), // 自分のメールアドレスを除外
        ],
        'password' => 'required|min:8|max:20|confirmed',
        'password_confirmation' =>'required|min:8|max:20',
        'bio' => 'string|max:150',
        'icon' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg',
    ]);

    // if ($request->filled('password')) {
    //     $user->password = Hash::make($request->password);
    // }

    if ($request->hasFile('icon')) {
        // 古いアイコンがあれば削除
        if ($user->icon_image && file_exists(public_path('images/' . $user->icon_image))) {
            unlink(public_path('images/' . $user->icon_image));
        }
        // ファイルの拡張子を取得
        $extension = $request->file('icon')->getClientOriginalExtension();
        // ユニークなファイル名を生成
        $fileName = Str::random(10) . '.' . $extension;
        $iconPath = $request->file('icon')->storeAs('images',$fileName, 'public');
        $user->icon_image = $fileName;
    }

    $user->update(['username' => $request->username,
    'email' => $request->email,
    'password' =>Hash::make($request['password']),
    'bio' => $request->bio,]);

    // return redirect()->route('profile')->with('success', 'プロフィールを更新しました');
    return redirect()->route('top');
}
}
