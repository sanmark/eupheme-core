<?php

namespace App\Handlers\Tests ;

use App\Handlers\HandlerGroups ;
use App\Models\Group ;
use App\Repos\Contracts\RepoGroups ;
use App\Validators\Contracts\ValidatorGroups ;
use Tests\TestCase ;
use function dd ;

/**
 * @codeCoverageIgnore
 */
class Groups_Update_Test extends TestCase
{

	public function test_ok ()
	{
		$repoGroups = $this -> mock ( RepoGroups::class ) ;
		$validatorGroups = $this -> mock ( ValidatorGroups::class ) ;

		$handlerGroups = new HandlerGroups ( $repoGroups , $validatorGroups ) ;

		$validatorGroups
			-> shouldReceive ( 'update' )
			-> withArgs ( [
				[
					'name' => 'new-name' ,
					'ref' => 'new-ref' ,
					'parentId' => 150 ,
				] ,
			] )
		;

		$group = $this -> mock ( Group::class ) ;

		$repoGroups
			-> shouldReceive ( 'update' )
			-> withArgs ( [
				149 ,
				'new-name' ,
				'new-ref' ,
				150 ,
			] )
			-> andReturn ( $group )
		;

		$response = $handlerGroups -> update ( 149 , [
			'name' => 'new-name' ,
			'ref' => 'new-ref' ,
			'parentId' => 150 ,
			] ) ;

		$this -> assertSame ( $group , $response ) ;
	}

}
