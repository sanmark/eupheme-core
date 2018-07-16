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
class Groups_Create_Test extends TestCase
{

    public function test_ok()
    {
        $repoGroups = $this -> mock(RepoGroups::class);
        $validatorGroups = $this -> mock(ValidatorGroups::class);

        $handlerGroups = new HandlerGroups ($repoGroups, $validatorGroups);

        $data = [
            'name' => 'foo',
            'ref' => 'bar',
            'parentId' => 149,
        ];

        $validatorGroups
            -> shouldReceive('create')
            -> withArgs([$data]);

        $group = $this -> mock(Group::class);

        $repoGroups
            -> shouldReceive('create')
            -> withArgs([
                'foo',
                'bar',
                149,
            ])
            -> andReturns($group);

        $response = $handlerGroups -> create($data);

        $this -> assertSame($group, $response);
    }

}
