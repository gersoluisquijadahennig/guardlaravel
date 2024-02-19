<?php

namespace App\Providers;

use App\Models\PanelUser;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class MyUserProvider implements UserProvider
{

    public function retrieveById($identifier)
    {
        // Recupera un usuario por su ID
        dd($identifier);
        return PanelUser::find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        dd($identifier);
        // Recupera un usuario por su ID y token de "remember"
        return PanelUser::where('id', $identifier)
            ->where('remember_token', $token)
            ->first();
    }

    public function retrieveByCredentials(array $credentials)
    {
        dd($credentials);
        // Recupera un usuario por sus credenciales (rut y clave)
        return PanelUser::where('run', $credentials['run'])
            ->where('clave', $credentials['clave'])
            ->first();
    }

    public function updateRememberToken(Authenticatable $user, $token){
        dd($user);

    }
    public function validateCredentials(Authenticatable $user, array $credentials){

        dd($credentials);
    }
}