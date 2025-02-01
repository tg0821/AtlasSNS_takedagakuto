<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
// authcontrollerの追加用
use App\Http\Controllers\AuthController;

// FollowsControllerの追加用
use App\Http\Controllers\FollowsController;

// ログアウト機能の追加
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

//  Route::get('top', [PostsController::class, 'index']);

//  Route::get('profile', [ProfileController::class, 'profile']);

//  Route::get('search', [UsersController::class, 'index']);

//  Route::get('follow-list', [PostsController::class, 'index']);
//  Route::get('follower-list', [PostsController::class, 'index']);

// Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('login', [AuthController::class, 'login']);

// 認証が不要なルート
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
// 認証が必要なルート
Route::middleware(['auth'])->group(function () {
    Route::get('top', [PostsController::class, 'index'])->name('top');
    Route::get('profile', [ProfileController::class, 'profile']);
    // プロフィール編集のルート新規追加
    Route::post('profile-update',[ProfileController::class,'update'])->name('profile.update');
    Route::get('search', [UsersController::class, 'search'])->name('search');
    Route::get('/follow-list', [PostsController::class, 'followlist']);
    Route::get('/follower-list', [PostsController::class, 'followers']);
    //投稿機能のためのルート
    Route::post('/post/create',[PostsController::class,'postcreates']);

// 削除機能のためのルート
    Route::get('/post/delete',[PostsController::class,'delete']);

// フォロー、フォロー解除のルート
    Route::post('/follow/{user}', [FollowsController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowsController::class, 'unfollow'])->name('unfollow');
});

// ログアウト機能追加
    Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('login'); // ログイン画面にリダイレクト
    })->name('logout');
