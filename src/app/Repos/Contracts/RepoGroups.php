<?php

namespace App\Repos\Contracts;

use App\Models\Group;

interface RepoGroups
{

    public function all(): array;

    public function create(
        string $name
        ,
        string $ref
        ,
        int $parentId = null
    ): Group;

    public function one(int $id): Group;

    public function update(
        int $id
        ,
        string $name
        ,
        string $ref
        ,
        int $parentId = null
    ): Group;
}
