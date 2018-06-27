<?php

namespace App\Repos\Concretes\Eloquent\Repos\Tests ;

use App\Models\Group ;
use App\Repos\Concretes\Eloquent\Models\EloquentGroup ;
use App\Repos\Concretes\Eloquent\Repos\ConcreteRepoGroups ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_Create_Test extends TestCase
{

	public function test_ok ()
	{
		$eloquentGroup = $this -> mock ( EloquentGroup::class ) ;

		$concereteRepoGroups = new ConcreteRepoGroups ( $eloquentGroup ) ;

		$name = 'the-name' ;
		$ref = 'the-ref' ;
		$parentId = 149 ;

		$eloquentGroup
			-> shouldReceive ( 'newInstance' )
			-> withNoArgs ()
			-> andReturnSelf ()
		;

		$eloquentGroup
			-> shouldReceive ( 'setAttribute' )
			-> withArgs ( [
				'name' ,
				'the-name' ,
			] )
		;

		$eloquentGroup
			-> shouldReceive ( 'setAttribute' )
			-> withArgs ( [
				'ref' ,
				'the-ref' ,
			] )
		;

		$eloquentGroup
			-> shouldReceive ( 'setAttribute' )
			-> withArgs ( [
				'parent_id' ,
				149 ,
			] )
		;

		$eloquentGroup
			-> shouldReceive ( 'save' )
			-> withNoArgs ()
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'id' ] )
			-> andReturn ( 'the-id' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'name' ] )
			-> andReturn ( 'the-name' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'parent_id' ] )
			-> andReturn ( 'the-parent_id' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'ref' ] )
			-> andReturn ( 'the-ref' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getCreatedAtTimestampOrNull' )
			-> withNoArgs ()
			-> andReturn ( 'the-created-at-timestamp' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getUpdatedAtTimestampOrNull' )
			-> withNoArgs ()
			-> andReturn ( 'the-updated-at-timestamp' )
		;

		$response = $concereteRepoGroups -> create ( $name , $ref , $parentId ) ;

		$expectedObject = new Group() ;
		$expectedObject -> id = 'the-id' ;
		$expectedObject -> name = 'the-name' ;
		$expectedObject -> parentId = 'the-parent_id' ;
		$expectedObject -> ref = 'the-ref' ;
		$expectedObject -> createdAt = 'the-created-at-timestamp' ;
		$expectedObject -> updatedAt = 'the-updated-at-timestamp' ;

		$this -> assertEquals ( $expectedObject , $response ) ;
	}

}
