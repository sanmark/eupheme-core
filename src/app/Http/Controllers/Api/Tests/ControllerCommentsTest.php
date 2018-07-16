<?php

namespace App\Http\Controllers\Api\Tests;


use App\Handlers\HandlerComments;
use App\Http\Controllers\Api\ControllerComments;
use App\Models\Comment;
use App\Validators\Exceptions\InvalidInputException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class ControllerCommentsTest extends TestCase
{

    public function test_create_success()
    {
        $handlersComment = $this -> mock(HandlerComments::class);

        $mockComment = $this -> mock(Comment::class);
        $mockComment -> text = 'foo';
        $mockComment -> id = 1;
        $mockComment->extRef = null;
        $mockComment->parentID= null;
        $mockComment->userID = null;
        $mockComment->status = null;

        $controllerComment = new ControllerComments($handlersComment);

        $handlersComment -> shouldReceive('create')
            -> once()
            -> withArgs([
                ['text' => 'foo']
            ])
            -> andReturn($mockComment);

        $request = new Request([
            'text' => 'foo'
        ]);

        $payload = [
            'text' => 'foo',
            'id' => 1,
            'extRef' => null,
            'parentID' => null,
            'userID' => null,
            'status' => null,
            'createdAt' => null,
            'updatedAt' =>null
        ];

        $response = $controllerComment -> create($request);

        $this -> assertInstanceOf(JsonResponse::class, $response);

        $this -> assertEquals(200, $response->getStatusCode());

        $this -> assertEquals((object)[
            'payload' => (object)$payload
        ], $response -> getData());

    }

    public function test_create_fail_text_not_available()
    {

        $mockHandlerComment = $this -> mock(HandlerComments::class);

        $mockException = $this ->mock(InvalidInputException::class);

        $mockHandlerComment -> shouldReceive('create')
            -> once()
            -> andThrow($mockException);

        $mockException -> shouldReceive('getErrors')
            ->once()
            ->andReturn([]);

        $controllerComment = new ControllerComments($mockHandlerComment);

        $request = new Request();

        $response = $controllerComment -> create($request);

        $this -> assertInstanceOf(JsonResponse::class, $response);

        $this -> assertEquals(422, $response->status());
    }
}