<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PanelUser;
use App\Models\User;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Event;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ListUsers($layout = null)
    {
        if($layout=='adminlte'){
            $layout="layouts.dashboard.app";
        }else{
            $layout="layouts.none";
        }

        return view('user.user', ['layout' => $layout]);
    }

    
    public function DatosListadoUsuarios(){
        $users = PanelUser::all();
        return response()->json(['data' => $users]);
    }

    public function AddUser()
    {
        return view('user.adduser');
    }

    public function SaveUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/user');
    }

    public function EditUser($id){
        $user = User::find($id);
        return view('user.edituser', ['user' => $user]);
    }

    public function UpdateUser(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/user');
    }

    public function DeleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
