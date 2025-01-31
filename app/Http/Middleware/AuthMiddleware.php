<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ログインページにアクセスしている場合はリダイレクトしない
    // if ($request->routeIs('login')) {
    //     return $next($request);
    // }
    // ログインページにアクセスしている場合はリダイレクトしない
    if ($request->routeIs('login') || $request->routeIs('register')) {
        return $next($request);
    }
        // // ユーザーがログインしいない場合は、ログインページにリダイレクト
        // if(!auth()->check()){
        //     return redirect()->route('login');
        // }
        // 次のミドルウェアまたはコントローラーを実行
    }
}
