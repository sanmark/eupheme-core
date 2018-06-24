<?php

namespace App\Handlers ;

use App\Repos\Contracts\RepoGroups ;

class HandlerGroups
{

	private $repoGroups ;

	public function __construct (
	RepoGroups $repoGroups
	)
	{
		$this -> repoGroups = $repoGroups ;
	}

	public function all ()
	{
		$groups = $this
			-> repoGroups
			-> all ()
		;

		return $groups ;
	}

}
