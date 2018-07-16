<?php

namespace App\Handlers\Tests;

use App\Handlers\HandlerGroups;
use App\Models\Group;
use App\Repos\Contracts\RepoGroups;
use App\Validators\Contracts\ValidatorGroups;
use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
class Groups_One_Test extends TestCase
{

    public function test_ok()
    {
        $repoGroups = $this -> mock(RepoGroups::class);
        $validatorGroups = $this -> mock(ValidatorGroups::class);

        $handlerGroups = new HandlerGroups ($repoGroups, $validatorGroups);

        $group = $this -> mock(Group::class);

        $repoGroups
            -> shouldReceive('one')
            -> withArgs([149])
            -> andReturn($group);

        $response = $handlerGroups -> one(149);

        $this -> assertSame($group, $response);
    }

}
