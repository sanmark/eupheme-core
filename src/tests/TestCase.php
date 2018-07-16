<?php

namespace Tests;

use App\Constants\ConstantsHeader;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use function app;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;

    private $hasher;

    protected function getWithInvalidAppKeyAndSecretHash(string $uri, array $headers = [])
    {
        $headers = $this -> attachInvalidAppKeyAndSecretHashToHeadersArray($headers);
        return parent ::get($uri, $headers);
    }

    private function attachInvalidAppKeyAndSecretHashToHeadersArray(array $headers)
    {
        $hash = $this
            -> hasher
            -> make('sec');

        $headers[ConstantsHeader::APP_KEY] = 'invalid-key';
        $headers[ConstantsHeader::APP_SECRET_HASH] = $hash;

        return $headers;
    }

    protected function getWithValidAppKeyAndInvalidSecretHash(string $uri, array $headers = [])
    {
        $headers = $this -> attachValidAppKeyAndInvalidSecretHashToHeadersArray($headers);
        return parent ::get($uri, $headers);
    }

    private function attachValidAppKeyAndInvalidSecretHashToHeadersArray(array $headers)
    {
        $hash = $this
            -> hasher
            -> make('invalid-sec');

        $headers[ConstantsHeader::APP_KEY] = 'key';
        $headers[ConstantsHeader::APP_SECRET_HASH] = $hash;

        return $headers;
    }

    protected function getWithValidAppKeyAndSecretHash(string $uri, array $headers = [])
    {
        $headers = $this -> attachValidAppKeyAndSecretHashToHeadersArray($headers);
        return parent ::get($uri, $headers);
    }

    private function attachValidAppKeyAndSecretHashToHeadersArray(array $headers)
    {
        $hash = $this
            -> hasher
            -> make('sec');

        $headers[ConstantsHeader::APP_KEY] = 'key';
        $headers[ConstantsHeader::APP_SECRET_HASH] = $hash;

        return $headers;
    }

    protected function mock(string $className, array $constructorArgs = null)
    {
        if (is_null($constructorArgs)) {
            return Mockery ::mock($className);
        }

        return Mockery ::mock($className, $constructorArgs);
    }

    protected function patchWithInvalidAppKeyAndSecretHash(string $uri, array $data = [], array $headers = [])
    {
        $headers = $this -> attachInvalidAppKeyAndSecretHashToHeadersArray($headers);
        return parent ::patch($uri, $data, $headers);
    }

    protected function patchWithValidAppKeyAndSecretHash(string $uri, array $data = [], array $headers = [])
    {
        $headers = $this -> attachValidAppKeyAndSecretHashToHeadersArray($headers);
        return parent ::patch($uri, $data, $headers);
    }

    protected function patchWithValidAppKeyAndInvalidSecretHash(string $uri, array $data = [], array $headers = [])
    {
        $headers = $this -> attachValidAppKeyAndInvalidSecretHashToHeadersArray($headers);
        return parent ::patch($uri, $data, $headers);
    }

    protected function postWithInvalidAppKeyAndSecretHash(string $uri, array $data = [], array $headers = [])
    {
        $headers = $this -> attachInvalidAppKeyAndSecretHashToHeadersArray($headers);
        return parent ::post($uri, $data, $headers);
    }

    protected function postWithValidAppKeyAndSecretHash(string $uri, array $data = [], array $headers = [])
    {
        $headers = $this -> attachValidAppKeyAndSecretHashToHeadersArray($headers);
        return parent ::post($uri, $data, $headers);
    }

    protected function postWithValidAppKeyAndInvalidSecretHash(string $uri, array $data = [], array $headers = [])
    {
        $headers = $this -> attachValidAppKeyAndInvalidSecretHashToHeadersArray($headers);
        return parent ::post($uri, $data, $headers);
    }

    protected function setUp()
    {
        parent ::setUp();

        $this -> artisan('migrate');

        $this -> hasher = app(Hasher::class);
    }

    protected function tearDown()
    {
        $this -> artisan('migrate:reset');
        parent ::tearDown();
    }

}
