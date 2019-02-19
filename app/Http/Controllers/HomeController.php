<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * ユーザログを返すAPI
     *
     * @return json
     */
    public function apiGetUserLogs()
    {
        $user_logs = Auth::user()->logs;

        return response()->json($user_logs);
    }
}
