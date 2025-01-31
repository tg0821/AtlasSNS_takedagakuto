<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ダッシュボードビューを返す
        return view('dashboard');
    }
}
