<?php

namespace App\Repos\Contracts ;

use App\Models\Group ;

interface RepoGroups
{

	public function all (): array ;

	public function create (
	string $name
	, string $ref
	, int $parentId = NULL
	): Group ;

	public function one ( int $id ): Group ;
}
