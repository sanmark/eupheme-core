<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
abstract class Base extends TestCase
{

    protected $url;
    protected $httpVerb;

    public function test_rejectsNoAppKeyAndSecretHash()
    {
        $response = $this ->{$this -> httpVerb} ($this -> url);

        $response -> assertStatus(401);

        $response -> assertJson(['errors' => [],], true);
    }

    public function test_rejectsInvalidAppKey()
    {
        $response = $this ->{$this -> httpVerb . 'WithInvalidAppKeyAndSecretHash'} ($this -> url);

        $response -> assertStatus(401);

        $response -> assertJson(['errors' => [],], true);
    }

    public function test_rejectsInvalidSecretHash()
    {
        $response = $this ->{$this -> httpVerb . 'WithValidAppKeyAndInvalidSecretHash'} ($this -> url);

        $response -> assertStatus(401);

        $response -> assertJson(['errors' => [],], true);
    }

}
