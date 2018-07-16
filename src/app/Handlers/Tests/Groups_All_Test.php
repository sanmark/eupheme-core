<?php

namespace App\Handlers\Tests;

use App\Handlers\HandlerGroups;
use App\Repos\Contracts\RepoGroups;
use App\Validators\Contracts\ValidatorGroups;
use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
class HandlerGroups_All_Test extends TestCase
{

    public function test_ok()
    {
        $repoGroups = $this -> mock(RepoGroups::class);
        $validatorGroups = $this -> mock(ValidatorGroups::class);

        $handlerGroups = new HandlerGroups ($repoGroups, $validatorGroups);

        $repoGroups
            -> shouldReceive('all')
            -> withNoArgs()
            -> andReturn([149,]);

        $response = $handlerGroups -> all();

        $this -> assertEquals([149,], $response);
    }

}
