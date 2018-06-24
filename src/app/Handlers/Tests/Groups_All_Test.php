<?php

namespace App\Handlers\Tests ;

use App\Handlers\HandlerGroups ;
use App\Repos\Contracts\RepoGroups ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class HandlerGroups_All_Test extends TestCase
{

	public function test_ok ()
	{
		$repoGroup = $this -> mock ( RepoGroups::class ) ;

		$handlerGroups = new HandlerGroups ( $repoGroup ) ;

		$repoGroup
			-> shouldReceive ( 'all' )
			-> withNoArgs ()
			-> andReturn ( [ 149 , ] )
		;

		$response = $handlerGroups -> all () ;

		$this -> assertEquals ( [ 149 , ] , $response ) ;
	}

}
