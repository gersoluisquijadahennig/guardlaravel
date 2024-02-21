<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class CustomEloquentUserProvider extends \Illuminate\Auth\EloquentUserProvider
{

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    

     public function validateCredentials(UserContract $user, array $credentials)
    {
        //dd($credentials);
        if (is_null($plain = $credentials['password'])) {
            return false;
        }else{
            $plain = $credentials['password'];
        }
        /**
         * Comparamos con algoritmo MD5 encriptado en la base de datos Oracle
         */

        //dd(hash('md5', $plain).' == '.$user->getAuthPassword());
        return hash('md5', $plain) === $user->getAuthPassword();
    }

    


}