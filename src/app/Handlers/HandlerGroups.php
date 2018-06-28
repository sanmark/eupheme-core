<?php

namespace App\Handlers ;

use App\Models\Group ;
use App\Repos\Contracts\RepoGroups ;
use App\Validators\Contracts\ValidatorGroups ;

class HandlerGroups
{

	private $repoGroups ;
	private $validatorGroups ;

	public function __construct (
	RepoGroups $repoGroups
	, ValidatorGroups $validatorGroups
	)
	{
		$this -> repoGroups = $repoGroups ;
		$this -> validatorGroups = $validatorGroups ;
	}

	public function all (): array
	{
		$groups = $this
			-> repoGroups
			-> all ()
		;

		return $groups ;
	}

	public function create ( array $data ): Group
	{
		$this
			-> validatorGroups
			-> create ( $data )
		;

		$name = $data[ 'name' ] ;
		$ref = $data[ 'ref' ] ;

		$parentId = NULL ;
		if ( array_key_exists ( 'parentId' , $data ) )
		{
			$parentId = $data[ 'parentId' ] ;
		}

		$group = $this
			-> repoGroups
			-> create ( $name , $ref , $parentId ) ;
		;

		return $group ;
	}

	public function one ( int $id ): Group
	{
		$group = $this
			-> repoGroups
			-> one ( $id )
		;

		return $group ;
	}

}
