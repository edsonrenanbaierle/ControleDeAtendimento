<?php

namespace App\controller;

use App\http\Response;

class NotFoundRoute
{
    public function notFoundRoute()
    {
        $body = [
            "erro" => true,
            "sucess" => false,
            "message" => "Rota definida não encontrada"
        ];

        Response::responseMessage($body, 404);
    }
}
