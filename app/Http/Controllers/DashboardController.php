<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //admin dashboard
    public function AdminDashboard(Request $request){
        // dd(Session::has('isLogin'));
        // dd(Auth::login);
        return view('home');
    }
}
