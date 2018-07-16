<?php

namespace App\Http\Responses;

class SuccessResponse
{

    private $data;
    private $statusCode;

    public function __construct($data, $statusCode = 200)
    {
        $this -> data = $data;
        $this -> statusCode = $statusCode;
    }

    public function getResponse()
    {
        return
            response()
                -> json([
                    'payload' => $this -> data,
                ])
                -> setStatusCode($this -> statusCode);
    }

}
