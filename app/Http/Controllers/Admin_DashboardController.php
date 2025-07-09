<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\category;

class Admin_DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = user::count();
        $totalCategory = category::count();

        return view('dashboard', compact('totalUsers', 'totalCategory'));
    }
}
