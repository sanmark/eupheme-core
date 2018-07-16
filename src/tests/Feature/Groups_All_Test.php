<?php

namespace Tests\Feature;

/**
 * @codeCoverageIgnore
 */
class Groups_All_Test extends Base
{

    protected $url = 'api/groups';
    protected $httpVerb = 'get';

    public function test_ok()
    {
        $this -> seed();

        $response = $this -> getWithValidAppKeyAndSecretHash('api/groups');

        $response -> assertStatus(200);

        $response -> assertJson([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'vehicles',
                    'parentId' => null,
                    'ref' => 'vehicles',
                    'deletedAt' => null,
                ],
                [
                    'id' => 2,
                    'name' => 'vacancies',
                    'parentId' => null,
                    'ref' => 'vacancies',
                    'deletedAt' => null,
                ],
            ],
        ], true);
    }

}
