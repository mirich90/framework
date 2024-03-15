<?php

namespace App\Functions;

class FAuth
{
    public static function isLogin($page_redirect = '/login')
    {
        if (!FUser::isLogin()) {
            FResponse::create([
                "status" => 401,
                'message' => 'Зарегистрируйтесь, чтобы пользоваться всеми возможностями сайта',
                "data" => [],
                'class' => 'Login'
            ]);
            redirect($page_redirect);
            die;
        }
        return true;
    }

    public static function isLoginApi($page_redirect = '/login')
    {

        if (!FUser::isLogin()) {
            echo FResponse::create([
                "status" => 401,
                'message' => 'Зарегистрируйтесь, чтобы пользоваться всеми возможностями сайта',
                "data" => [],
                'class' => 'Login'
            ]);
            die;
        }
    }
}
