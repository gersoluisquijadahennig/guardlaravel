<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PanelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{

    public function FindUserPanel()
    {
        dd(Auth::check());
        if (Auth::check()) {
            $users = PanelUser::all();
            return view('user-panel.user-panel', compact('users'));
        }else{
            return redirect()->route('user-panel.user-panel');
        }
    }
}
