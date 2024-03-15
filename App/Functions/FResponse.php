<?php

namespace App\Functions;

class FResponse
{
    public static function create($response = null, $class = null)
    {
        if ($response === null) {
            $response = [
                "status" => 200,
                'message' => 'Запрос успешен',
                "data" => [],
                'class' => 'Login'
            ];
        }
        if ($class) {
            $response["class"] = $class;
        }
        $json = JSON($response);
        $_SESSION['request'] = $json;
        return $json;
    }
}
