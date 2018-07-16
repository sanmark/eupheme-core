<?php

namespace App\Http\Middleware;

use App\Constants\ConstantsHeader;
use App\Http\Responses\ErrorResponse;
use Closure;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use function config;

class MiddlewareAppVerify
{

    private $hasher;

    public function __construct(Hasher $hasher)
    {
        $this -> hasher = $hasher;
    }

    public function handle(Request $request, Closure $next)
    {
        $key = $request -> header(ConstantsHeader::APP_KEY);
        $secretHash = $request -> header(ConstantsHeader::APP_SECRET_HASH);

        $keys = config('apps.keys');

        if (
            !is_null($key) &&
            !is_null($secretHash) &&
            array_key_exists($key, $keys) &&
            $this -> hasher -> check($keys[$key], $secretHash)
        ) {
            return $next ($request);
        }

        $response = new ErrorResponse ([], 401);

        return $response -> getResponse();
    }

}
