<?php

namespace Tests\Feature;

/**
 * @codeCoverageIgnore
 */
class Groups_One_Test extends Base
{

    protected $url = 'api/groups/1';
    protected $httpVerb = 'get';

    public function test_ok()
    {
        $this -> seed();

        $response = $this -> getWithValidAppKeyAndSecretHash('api/groups/1');

        $response -> assertStatus(200);

        $response -> assertJson([
            'data' => [
                'id' => 1,
                'name' => 'vehicles',
                'parentId' => null,
                'ref' => 'vehicles',
                'deletedAt' => null,
            ],
        ]);
    }

    public function test_invalidId()
    {
        $this -> seed();

        $response = $this -> getWithValidAppKeyAndSecretHash('api/groups/3');

        $response -> assertStatus(404);

        $response -> assertJson(['errors' => []]);
    }

}
