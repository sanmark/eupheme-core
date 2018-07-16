<?php

namespace App\Http\Middleware\Tests;

use App\Constants\ConstantsHeader;
use App\Http\Middleware\MiddlewareAppVerify;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
class MiddlewareAppVerify_Handle_Test extends TestCase
{

    public function test_ok()
    {
        $hasher = $this -> mock(Hasher::class);

        $middlewareAppVerify = new MiddlewareAppVerify ($hasher);

        $request = $this -> mock(Request::class);
        $next = function ($requestProvidedToNext) use ($request) {
            if ($requestProvidedToNext === $request) {
                return 149;
            }
        };

        $request
            -> shouldReceive('header')
            -> withArgs([ConstantsHeader::APP_KEY])
            -> andReturn('key');

        $request
            -> shouldReceive('header')
            -> withArgs([ConstantsHeader::APP_SECRET_HASH])
            -> andReturn('sec-hashed');

        $hasher
            -> shouldReceive('check')
            -> withArgs([
                'sec',
                'sec-hashed',
            ])
            -> andReturn(true);

        $response = $middlewareAppVerify -> handle($request, $next);

        $this -> assertSame(149, $response);
    }

    public function test_handle_rejectsEmptyAppKeyAndSecretHash()
    {
        $hasher = $this -> mock(Hasher::class);

        $middlewareAppVerify = new MiddlewareAppVerify ($hasher);

        $request = $this -> mock(Request::class);
        $next = function ($requestProvidedToNext) use ($request) {

        };

        $request
            -> shouldReceive('header')
            -> withArgs([ConstantsHeader::APP_KEY])
            -> andReturnNull();

        $request
            -> shouldReceive('header')
            -> withArgs([ConstantsHeader::APP_SECRET_HASH])
            -> andReturnNull();

        $response = $middlewareAppVerify -> handle($request, $next);

        $this -> assertInstanceOf(JsonResponse::class, $response);
        $this -> assertEquals(401, $response -> getStatusCode());
        $this -> assertEquals(( object )[
            'errors' => [
            ],
        ], $response -> getData());
    }

}
