<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAuthenticated
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
        // ユーザーがログインしていなければ、ログインページにリダイレクト
        if (!auth()->check()) {
            return redirect()->route('login');  // 'login'はログインページへのルート名
        }
        // 条件を条件を満たした場合条件を満たした場合、次の処理に進む
        return $next($request);
    }
}
