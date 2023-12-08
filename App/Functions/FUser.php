<?php

namespace App\Functions;

class FUser
{
    public static function getUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return NULL;
    }

    public static function getParam($user, $name)
    {
        return ($user && isset($user[$name])) ? $user[$name] : '';
    }

    public static function getMail()
    {
        $user = self::getUser();
        return self::getParam($user, 'email');
    }

    public static function getRole()
    {
        $user = self::getUser();
        return self::getParam($user, 'role');
    }

    public static function checkRole($role)
    {
        return  $role === self::getRole();
    }

    public static function isLogin()
    {
        return (self::getUser());
    }
}
