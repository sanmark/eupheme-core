<?php

namespace App\Repos\Concretes\Eloquent\Repos ;

use App\Models\Group ;
use App\Repos\Concretes\Eloquent\Models\EloquentGroup ;
use App\Repos\Contracts\RepoGroups ;

class ConcreteRepoGroups implements RepoGroups
{

	private $eloquentGroup ;

	public function __construct (
	EloquentGroup $eloquentGroup
	)
	{
		$this -> eloquentGroup = $eloquentGroup ;
	}

	public function all (): array
	{
		$eloquentGroups = $this
			-> eloquentGroup
			-> all ()
		;

		$groups = [] ;

		foreach ( $eloquentGroups as $eloquentGroup )
		{
			/* @var $eloquentGroup EloquentGroup */

			$group = new Group() ;

			$group -> id = $eloquentGroup -> id ;
			$group -> name = $eloquentGroup -> name ;
			$group -> parentId = $eloquentGroup -> parent_id ;
			$group -> ref = $eloquentGroup -> ref ;
			$group -> deletedAt = $eloquentGroup -> getDeletedAtTimestampOrNull () ;
			$group -> createdAt = $eloquentGroup -> getCreatedAtTimestampOrNull () ;
			$group -> updatedAt = $eloquentGroup -> getUpdatedAtTimestampOrNull () ;

			$groups[] = $group ;
		}

		return $groups ;
	}

	public function create (
	string $name
	, string $ref
	, int $parentId = NULL
	): Group
	{
		/* @var $eloquentGroup EloquentGroup */
		$eloquentGroup = $this
			-> eloquentGroup
			-> newInstance () ;

		$eloquentGroup -> name = $name ;
		$eloquentGroup -> ref = $ref ;

		if ( ! is_null ( $parentId ) )
		{
			$eloquentGroup -> parent_id = $parentId ;
		}

		$eloquentGroup -> save () ;

		$group = new Group() ;

		$group -> id = $eloquentGroup -> id ;
		$group -> name = $eloquentGroup -> name ;
		$group -> parentId = $eloquentGroup -> parent_id ;
		$group -> ref = $eloquentGroup -> ref ;
		$group -> createdAt = $eloquentGroup -> getCreatedAtTimestampOrNull () ;
		$group -> updatedAt = $eloquentGroup -> getUpdatedAtTimestampOrNull () ;

		return $group ;
	}

}
