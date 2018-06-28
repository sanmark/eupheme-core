<?php

namespace App\Http\Controllers\Api\Tests ;

use App\Handlers\HandlerGroups ;
use App\Http\Controllers\Api\ControllerGroups ;
use App\Models\Group ;
use App\Repos\Exceptions\RecordNotFoundException ;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_One_Test extends TestCase
{

	public function test_ok ()
	{
		$handlerGroups = $this -> mock ( HandlerGroups::class ) ;

		$controllerGroups = new ControllerGroups ( $handlerGroups ) ;

		$group = $this -> mock ( Group::class ) ;

		$group -> id = 149 ;
		$group -> name = 'the-name' ;
		$group -> parentId = 'the-parentId' ;
		$group -> ref = 'the-ref' ;
		$group -> deletedAt = 'the-deletedAt' ;
		$group -> createdAt = 'the-createdAt' ;
		$group -> updatedAt = 'the-updatedAt' ;

		$handlerGroups
			-> shouldReceive ( 'one' )
			-> withArgs ( [ 149 ] )
			-> andReturn ( $group ) ;

		/* @var $response JsonResponse */
		$response = $controllerGroups -> one ( 149 ) ;

		$this -> assertInstanceOf ( JsonResponse::class , $response ) ;
		$this -> assertSame ( 200 , $response -> status () ) ;
		$this -> assertEquals ( ( object ) [ 'data' => ( object ) [
					'id' => 149 ,
					'name' => 'the-name' ,
					'parentId' => 'the-parentId' ,
					'ref' => 'the-ref' ,
					'deletedAt' => 'the-deletedAt' ,
					'createdAt' => 'the-createdAt' ,
					'updatedAt' => 'the-updatedAt' ,
				] , ] , $response -> getData () ) ;
	}

	public function test_nonExistantId ()
	{
		$handlerGroups = $this -> mock ( HandlerGroups::class ) ;

		$controllerGroups = new ControllerGroups ( $handlerGroups ) ;

		$handlerGroups
			-> shouldReceive ( 'one' )
			-> withArgs ( [ 149 ] )
			-> andThrow ( RecordNotFoundException::class )
		;

		/* @var $response JsonResponse */
		$response = $controllerGroups -> one ( 149 ) ;

		$this -> assertInstanceOf ( JsonResponse::class , $response ) ;
		$this -> assertSame ( 404 , $response -> status () ) ;
		$this -> assertEquals ( ( object ) [ 'errors' => NULL ] , $response -> getData () ) ;
	}

}
