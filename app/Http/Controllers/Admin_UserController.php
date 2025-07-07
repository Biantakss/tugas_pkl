<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_UserController extends Controller
{
     public function index()
    {
        return view('layout-dashboard/users/user');
    }
}
