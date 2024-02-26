<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }
    
    protected function username(){
        return 'run';
    }   
    
    protected function validateLogin(Request $request)
    {
       
        $request->validate([
            $this->username() => 'required|string|exists:oracle.BIBLIOTECA_VIRTUAL.USUARIO_PANEL,run',
            'password' => 'required|string',
        ],
        [
            $this->username().'.exists' => 'El usuario no existe en la base de datos Postgres',

        ]);
    }

}
