<?php 

namespace App\Auth;

use Illuminate\Http\Request;
use App\Providers\MyUserProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomGuard implements Guard
{
    protected $request;
    protected $provider;
    protected $user;

    public function __construct(MyUserProvider $provider, Request $request)
  {
    $this->request = $request;
    $this->provider = $provider;
    $this->user = NULL;
  }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check(){

    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest(){

    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(){

        dd('this User :',$this->user);
        if (! is_null($this->user)) {
            return $this->user;
          }

    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id(){

    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = []){

        dd($credentials);

    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser(){

    }

    public function setUser(Authenticatable $user){
        
    }

}

