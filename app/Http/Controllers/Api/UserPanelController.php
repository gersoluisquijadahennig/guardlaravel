<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PanelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{

    public function ListUsersPanel()
    {
        
            $users = PanelUser::all();
            
            return response()->json($users);
   
    }
}
