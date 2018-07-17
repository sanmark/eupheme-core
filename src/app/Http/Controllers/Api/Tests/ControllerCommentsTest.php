<?php

namespace App\Http\Controllers\Api\Tests;


use App\Constants\ConstantsCommentStatus;
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
        $mockComment -> extRef = null;
        $mockComment -> parentID = null;
        $mockComment -> userID = null;
        $mockComment -> status = null;
        $mockComment -> children = [];

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
            'updatedAt' => null,
            'children' => []
        ];

        $response = $controllerComment -> create($request);

        $this -> assertInstanceOf(JsonResponse::class, $response);

        $this -> assertEquals(200, $response -> getStatusCode());

        $this -> assertEquals((object)[
            'payload' => (object)$payload
        ], $response -> getData());

    }

    public function test_create_fail_text_not_available()
    {

        $mockHandlerComment = $this -> mock(HandlerComments::class);

        $mockException = $this -> mock(InvalidInputException::class);

        $mockHandlerComment -> shouldReceive('create')
            -> once()
            -> andThrow($mockException);

        $mockException -> shouldReceive('getErrors')
            -> once()
            -> andReturn([]);

        $controllerComment = new ControllerComments($mockHandlerComment);

        $request = new Request();

        $response = $controllerComment -> create($request);

        $this -> assertInstanceOf(JsonResponse::class, $response);

        $this -> assertEquals(422, $response -> status());
    }

    public function test_get_success()
    {
        $mockHandlerComment = $this -> mock(HandlerComments::class);

        $payload = [
            'extRef' => 1,
            'parentID' => 2,
            'text' => 'foo',
            'userID' => 3,
            'status' => ConstantsCommentStatus::PENDING,
            'children' => []
        ];

        $mockHandlerComment -> shouldReceive('get')
            -> once()
            -> withArgs([1])
            -> andReturn([$payload]);

        $controllerComment = new ControllerComments($mockHandlerComment);

        $response = $controllerComment -> get(1);

        $this -> assertInstanceOf(JsonResponse::class, $response);

        $this -> assertEquals(200, $response -> status());

        $data = $response -> getData();

        $this -> assertEquals((object)[
            'payload' => [
                (object)$payload
            ]
        ], $data);
    }
}