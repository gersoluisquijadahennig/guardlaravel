<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class ApiLoginController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only($this->username(), 'password');

        if (Auth::guard('api')->attempt($credentials)) {

            //$request->session()->regenerate();// revisar en algun otro lugar llega

            $user = auth('api')->user();

            //dd($user->run);

            $userPostgres = User::where('run', $user->run)->first();    

            //dd($userPostgres);

            // Crear un nuevo token de acceso
            $token = $userPostgres->createToken($user->run)->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 200);

        } else {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
    }


    protected function username()
    {
        return 'run';
    }

    protected function validateLogin(Request $request)
    {

        $request->validate(
            [
                $this->username() => 'required|string|exists:oracle.BIBLIOTECA_VIRTUAL.USUARIO_PANEL,run',
                'password' => 'required|string',
            ],
            [
                $this->username() . '.exists' => 'El usuario no existe',

            ]
        );
    }

}
