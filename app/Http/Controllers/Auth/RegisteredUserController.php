<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
        'username' => 'required|string|min:2|max:12', // UserName: 必須、2～12文字
        'email' =>  'required|email|min:5|max:40|unique:users,email', // メールアドレス: 必須、5～40文字、登録済み不可
        'password' => [
            'required',
            'string',
            'regex:/^[a-zA-Z0-9]+$/',  // 英数字のみ
            'min:8',
            'max:20',
            'confirmed', // Password確認用フィールドと一致しているか確認
        ],
    ]);
       $user = User::create([
            'username' => $validated['username'], // 配列としてアクセス
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
// セッションにユーザー名を保存
        session(['username' => $user->username]);

        return redirect('added')->with('success', 'User registered successfully.');
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
