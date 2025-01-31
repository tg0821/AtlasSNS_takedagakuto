<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;  // Postモデルを使う場合
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{

    public function index()
{
    // ログインユーザーを取得
    $user = Auth::user();

    // // フォロー数とフォロワー数を取得
    // followCount = $user->following()->count();
    // followerCount = $user->followers()->count();
    // dd($followCount,$followerCount);


    if (request()->has('all')) {
        $posts = Post::latest()->get(); // 全ての投稿を取得
    } else {
        $posts = Post::where('user_id', Auth::id())->latest()->get(); // 自分の投稿のみ
    };
    return view('posts.index', compact('posts'));
}


    // post機能のバリデーション
public function postcreates(Request $request){
$validatedData = $request->validate([
        'post' => 'required|string|min:1|max:150',
         ]);
          // 投稿をデータベースに保存
        Post::create([
            'post' => $validatedData['post'],
            'user_id' => Auth::id(), // ログイン中のユーザーID
        ]);
        // 検証済みデータを使用する処理
        // （例: データをビューに渡す、データベースに保存するなど）
        //  return view('posts.index', compact('validatedData'));
         return redirect()->route('top');  // 投稿後にトップページにリダイレクト
}

public function followlist(){
    // ログインユーザーがフォローしているアカウントを取得
        $followingUsers = Auth::user()->following()->get();
    // フォローしているユーザーの ID を抽出
        $followingUserIds = $followingUsers->pluck('id');
    // フォローしているアカウントのIDを上で取得しているのでその中から投稿を取得
        $posts = Post::whereIn('user_id',$followingUserIds)->get();
     return view('follows.followList', compact('followingUsers','posts'));
 }

 public function followers(){
    // ログインユーザーをフォローしているユーザーを取得
    $followerUsers = Auth::user()->followers()->get();
    // フォローされているユーザーIDを抽出
    $followerUsersIds = $followerUsers->pluck('id');
    // フォローされているアカウントの情報を上で取得したのでその中から投稿を取得
    $posts = Post::whereIn('user_id',$followerUsersIds)->get();
    // ビューにデータを渡して表示
    return view('follows.followerList', compact('followerUsers','posts'));
 }
}
