<?php

namespace App\Http\Controllers\Api\Tests;

use App\Handlers\HandlerGroups;
use App\Http\Controllers\Api\ControllerGroups;
use App\Models\Group;
use App\Validators\Exceptions\InvalidInputException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
class Groups_Create_Test extends TestCase
{

    public function test_ok()
    {
        $handlerGroups = $this -> mock(HandlerGroups::class);

        $controllerGroups = new ControllerGroups ($handlerGroups);

        /* @var $group  Group */
        $group = $this -> mock(Group::class);

        $group -> id = 'the-id';
        $group -> name = 'the-name';
        $group -> parentId = 'the-parentId';
        $group -> ref = 'the-ref';
        $group -> deletedAt = 'the-deletedAt';
        $group -> createdAt = 'the-createdAt';
        $group -> updatedAt = 'the-updatedAt';

        $handlerGroups
            -> shouldReceive('create')
            -> withArgs([
                [
                    'foo' => 'bar',
                    'bar' => 'qux',
                ],
            ])
            -> andReturn($group);

        $request = new Request ([
            'foo' => 'bar',
            'bar' => 'qux',
        ]);

        /* @var $response JsonResponse */
        $response = $controllerGroups -> create($request);

        $this -> assertInstanceOf(JsonResponse::class, $response);
        $this -> assertSame(201, $response -> status());
        $this -> assertEquals(
            ( object )[
                'data' => ( object )[
                    'id' => 'the-id',
                    'name' => 'the-name',
                    'parentId' => 'the-parentId',
                    'ref' => 'the-ref',
                    'deletedAt' => 'the-deletedAt',
                    'createdAt' => 'the-createdAt',
                    'updatedAt' => 'the-updatedAt',
                ],
            ]
            , $response -> getData()
        );
    }

    public function test_rejectsInvalidInput()
    {
        $handlerGroups = $this -> mock(HandlerGroups::class);

        $controllerGroups = new ControllerGroups ($handlerGroups);

        $invalidInputException = $this -> mock(InvalidInputException::class);

        $handlerGroups
            -> shouldReceive('create')
            -> withArgs([
                [
                    'foo' => 'bar',
                    'bar' => 'qux',
                ],
            ])
            -> andThrow($invalidInputException);

        $invalidInputException
            -> shouldReceive('getErrors')
            -> withNoArgs()
            -> andReturn(149);

        $request = new Request ([
            'foo' => 'bar',
            'bar' => 'qux',
        ]);

        /* @var $response JsonResponse */
        $response = $controllerGroups -> create($request);

        $this -> assertInstanceOf(JsonResponse::class, $response);
        $this -> assertSame(422, $response -> status());
        $this -> assertEquals(
            ( object )['errors' => 149,]
            , $response -> getData()
        );
    }

}
