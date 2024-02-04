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

    public static function getParam($user, $name, $default = '')
    {
        return ($user && isset($user[$name])) ? $user[$name] : $default;
    }

    public static function getMail()
    {
        $user = self::getUser();
        return self::getParam($user, 'email');
    }

    public static function getId()
    {
        $user = self::getUser();
        return self::getParam($user, 'id', 0);
    }

    public static function getAvatar()
    {
        $user = self::getUser();
        return self::getParam($user, 'avatar', 0);
    }

    public static function getInfo()
    {
        $user = self::getUser();
        return self::getParam($user, 'info', 0);
    }

    public static function getCity()
    {
        $user = self::getUser();
        return self::getParam($user, 'city', 0);
    }

    public static function getLink()
    {
        $user = self::getUser();
        return self::getParam($user, 'link', 0);
    }

    public static function getUsername()
    {
        $user = self::getUser();
        return self::getParam($user, 'username', 0);
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
