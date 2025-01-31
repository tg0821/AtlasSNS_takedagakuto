<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function search(Request $request){
        // return view('users.search');
// 現在のログインユーザーのIDを取得
        $currentUserId = Auth::id();

        // 検索キーワードを取得
        $query = $request->input('query');

        // キーワードが存在する場合のみ検索
        if ($query) {
            // データベースで検索（例: `name` カラムを検索）
            // $results = User::where('name', 'LIKE', "%{$query}%")->get();
            // 検索ワードと部分一致するユーザーを取得 (自分以外)
            $users = User::where('id', '!=', $currentUserId)
                ->where('username', 'LIKE', "%{$query}%")
                ->get();
        } else {
            // $results = collect(); // 空のコレクション
            // 検索ワードがない場合は、自分以外の全ユーザーを取得
            $users = User::where('id', '!=', $currentUserId)->get();
        }

        // 検索結果をビューに渡す
        return view('users.search', compact('users', 'query'));
    }
}
