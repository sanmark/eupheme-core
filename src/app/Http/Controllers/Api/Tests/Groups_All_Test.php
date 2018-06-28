<?php

namespace App\Http\Controllers\Api\Tests ;

use App\Handlers\HandlerGroups ;
use App\Http\Controllers\Api\ControllerGroups ;
use Illuminate\Http\JsonResponse ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class ControllerGroups_All_Test extends TestCase
{

	public function test_ok ()
	{
		$handlerGroups = $this -> mock ( HandlerGroups::class ) ;

		$controllerGroups = new ControllerGroups ( $handlerGroups ) ;

		$handlerGroups
			-> shouldReceive ( 'all' )
			-> withArgs ( [] )
			-> andReturn ( [ 149 ] )
		;

		/* @var $response JsonResponse */
		$response = $controllerGroups -> all () ;

		$this -> assertInstanceOf ( JsonResponse::class , $response ) ;
		$this -> assertSame ( 200 , $response -> status () ) ;
		$this -> assertEquals ( ( object ) [ 'data' => [ 149 ] , ] , $response -> getData () ) ;
	}

}
