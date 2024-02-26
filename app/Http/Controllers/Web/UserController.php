<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Event;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ListUsers($layout = null)
    {
        $users = User::all();

        if($layout=='adminlte'){
            $layout="layouts.dashboard.app";
        }else{
            $layout="layouts.app";
        }

        return view('user.user', ['users' => $users, 'layout' => $layout]);
    }
}
