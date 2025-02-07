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
use App\Models\User; // User モデルをインポート


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
        // 'storage/app/public/images/' に保存
        $iconPath = $request->file('icon')->storeAs('images',$fileName, 'public');
        // 'public/images' フォルダ内でファイルを保存
        // $request->file('icon')->move(public_path('images'), $fileName);
        // データベースのアイコン名を更新
        $user->icon_image =  basename($iconPath);
    }

    $user->update(['username' => $request->username,
    'email' => $request->email,
    'password' =>Hash::make($request['password']),
    'bio' => $request->bio,]);

    // return redirect()->route('profile')->with('success', 'プロフィールを更新しました');
    return redirect()->route('top');
}
// 相手ユーザープロフィール表示
    public function show($id)
    {
        $user = User::findOrFail($id);
        $authUser = Auth::user();
        if ($authUser) {
        $isFollowing = $authUser->following()->where('following_id', $id)->exists();
          if (!$isFollowing) {
          // フォローしていない場合の処理
          // 例えば「フォローしませんか？」のメッセージを表示したいなら
          $followSuggestion = "このユーザーをフォローしてみませんか？";
          }
          } else {
            $isFollowing = false;
}
        return view('profiles.user-profile', compact('user', 'isFollowing'));
    }
}
