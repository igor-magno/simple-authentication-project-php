<?php

namespace Src\Domain\Entities;

use Src\Domain\Entities\User;

class Auth
{
    private static null|User $user = null;
    
    public static function user(): User
    {
        return self::$user;
    }

    public static function setUser(User $authUser): void
    {
        if(!self::$user) self::$user = $authUser;
    }
}
