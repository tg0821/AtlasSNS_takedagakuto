<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追加したもの
use Illuminate\Support\Facades\Auth;
use App\Models\User;  // これを追加
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');  // ログインフォームを表示するビュー
    }

    /**
     * Handle login request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 入力されたデータを検証
        $credentials = $request->validate([

            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 認証処理
        if (Auth::attempt($credentials)) {
            // ログイン成功
            return redirect()->intended('top');  // ログイン後にトップページにリダイレクト
        }

        // 認証失敗
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function showRegistrationForm()
{
    return view('auth.register'); // 新規登録フォームを表示するビュー
}

public function register(Request $request)
    {
        // dd($request);
        // バリデーション
        $validatedData = $request->validate([
            'username' => 'required|string|min:2|max:12|',  // ユーザー名: 必須、2～12文字、ユニーク
            'email' => 'required|email|min:5|max:40|unique:users,email',  // メールアドレス: 必須、5～40文字、ユニーク
            'password' => 'required|string|min:8|max:20|confirmed',  // パスワード: 必須、8文字以上、確認用パスワード
        ]);

        // ユーザー作成
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // セッションにユーザー名を保存
    session(['username' => $user->username]);

    // // セッションに保存されたユーザー名を確認するためにデバッグ
    //  dd(session('username')); // セッション内容が表示される

        // ユーザー登録後にログイン
        Auth::login($user);

        return redirect('login');  // 登録後、ダッシュボードへリダイレクト
    }
}
