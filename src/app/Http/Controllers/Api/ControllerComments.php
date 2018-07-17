<?php

namespace App\Http\Controllers\Api;

use App\Handlers\HandlerComments;
use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Validators\Exceptions\InvalidInputException;
use Illuminate\Http\Request;

class ControllerComments extends Controller
{
    private $handlerComment;

    public function __construct(HandlerComments $handlerComments)
    {
        $this -> handlerComment = $handlerComments;
    }

    public function create(Request $request)
    {
        try {
            $comment = $this -> handlerComment -> create($request -> all());

            $response = new SuccessResponse($comment, 200);
            return $response -> getResponse();
        } catch (InvalidInputException $ex) {
            $errorResponse = new ErrorResponse($ex -> getErrors(), 422);
            return $errorResponse -> getResponse();
        }
    }

    public function get($id)
    {
        $comments = $this -> handlerComment -> get($id);

        $response = new SuccessResponse($comments, 200);
        return $response -> getResponse();
    }
}
