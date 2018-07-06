<?php

namespace App\Http\Controllers\Api\Tests ;

use App\Handlers\HandlerGroups ;
use App\Http\Controllers\Api\ControllerGroups ;
use App\Models\Group ;
use App\Repos\Exceptions\RecordNotFoundException ;
use App\Validators\Exceptions\InvalidInputException ;
use Illuminate\Http\JsonResponse ;
use Illuminate\Http\Request ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_Update_Test extends TestCase
{

	public function test_ok ()
	{
		$handlerGroups = $this -> mock ( HandlerGroups::class ) ;

		$controllerGroups = new ControllerGroups ( $handlerGroups ) ;

		$request = new Request ( [
			'foo' => 'bar' ,
			'baz' => 'qux' ,
			] )
		;

		$group = $this -> mock ( Group::class ) ;
		$group -> id = 149 ;
		$group -> name = 'the-name' ;
		$group -> parentId = 'the-parentId' ;
		$group -> ref = 'the-ref' ;
		$group -> deletedAt = 'the-deletedAt' ;
		$group -> createdAt = 'the-createdAt' ;
		$group -> updatedAt = 'the-updatedAt' ;

		$handlerGroups
			-> shouldReceive ( 'update' )
			-> withArgs ( [
				149 ,
				[
					'foo' => 'bar' ,
					'baz' => 'qux' ,
				] ,
			] )
			-> andReturn ( $group )
		;

		/* @var $response JsonResponse */
		$response = $controllerGroups -> update ( $request , 149 ) ;

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

	public function test_rejectsInvalidInputException ()
	{
		$handlerGroups = $this -> mock ( HandlerGroups::class ) ;

		$controllerGroups = new ControllerGroups ( $handlerGroups ) ;

		$invalidInputException = $this -> mock ( InvalidInputException::class ) ;

		$handlerGroups
			-> shouldReceive ( 'update' )
			-> withArgs ( [
				149 ,
				[
					'foo' => 'bar' ,
					'baz' => 'qux' ,
				] ,
			] )
			-> andThrow ( $invalidInputException )
		;

		$invalidInputException
			-> shouldReceive ( 'getErrors' )
			-> withNoArgs ()
			-> andReturn ( 150 )
		;

		$request = new Request ( [
			'foo' => 'bar' ,
			'baz' => 'qux' ,
			] )
		;

		/* @var $response JsonResponse */
		$response = $controllerGroups -> update ( $request , 149 ) ;

		$this -> assertInstanceOf ( JsonResponse::class , $response ) ;
		$this -> assertSame ( 422 , $response -> status () ) ;
		$this -> assertEquals (
			( object ) [ 'errors' => 150 , ]
			, $response -> getData ()
		) ;
	}

	public function test_nonExistantId ()
	{
		$handlerGroups = $this -> mock ( HandlerGroups::class ) ;

		$controllerGroups = new ControllerGroups ( $handlerGroups ) ;

		$handlerGroups
			-> shouldReceive ( 'update' )
			-> withArgs ( [
				149 ,
				[
					'foo' => 'bar' ,
					'baz' => 'qux' ,
				] ,
			] )
			-> andThrow ( RecordNotFoundException::class )
		;

		$request = new Request ( [
			'foo' => 'bar' ,
			'baz' => 'qux' ,
			] )
		;

		/* @var $response JsonResponse */
		$response = $controllerGroups -> update ( $request , 149 ) ;

		$this -> assertInstanceOf ( JsonResponse::class , $response ) ;
		$this -> assertSame ( 404 , $response -> status () ) ;
		$this -> assertEquals ( ( object ) [ 'errors' => NULL ] , $response -> getData () ) ;
	}

}
