<?php

namespace App\http;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function requestBody()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}
