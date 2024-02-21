<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ListUsers()
    {
        $users = User::all();
        return view('user.user', ['users' => $users]);
    }
}
