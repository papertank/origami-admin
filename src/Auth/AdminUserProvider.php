<?php

namespace Origami\Admin\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class AdminUserProvider extends EloquentUserProvider
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
        $plain = $credentials['password'];

        if ( ! $this->hasher->check($plain, $user->getAuthPassword()) ) {
            return false;
        }

        if ( ! $user->isAdmin() ) {
            return false;
        }

        return true;
    }

}
