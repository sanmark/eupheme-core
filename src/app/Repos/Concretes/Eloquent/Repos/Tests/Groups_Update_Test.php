<?php

namespace App\Repos\Concretes\Eloquent\Repos\Tests ;

use App\Models\Group ;
use App\Repos\Concretes\Eloquent\Models\EloquentGroup ;
use App\Repos\Concretes\Eloquent\Repos\ConcreteRepoGroups ;
use App\Repos\Exceptions\RecordNotFoundException ;
use Illuminate\Database\Eloquent\ModelNotFoundException ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_Update_Test extends TestCase
{

	public function test_ok ()
	{
		$eloquentGroup = $this -> mock ( EloquentGroup::class ) ;

		$concreteRepoGroups = new ConcreteRepoGroups ( $eloquentGroup ) ;

		$eloquentGroup
			-> shouldReceive ( 'findOrFail' )
			-> withArgs ( [ 149 ] )
			-> andReturnSelf ()
		;

		$eloquentGroup
			-> shouldReceive ( 'setAttribute' )
			-> withArgs ( [
				'name' ,
				'new-name' ,
			] )
		;

		$eloquentGroup
			-> shouldReceive ( 'setAttribute' )
			-> withArgs ( [
				'ref' ,
				'new-ref' ,
			] )
		;

		$eloquentGroup
			-> shouldReceive ( 'setAttribute' )
			-> withArgs ( [
				'parent_id' ,
				148 ,
			] )
		;

		$eloquentGroup
			-> shouldReceive ( 'save' )
			-> withNoArgs ()
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'id' ] )
			-> andReturn ( 149 )
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'name' ] )
			-> andReturn ( 'new-name' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'parent_id' ] )
			-> andReturn ( 148 )
		;

		$eloquentGroup
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'ref' ] )
			-> andReturn ( 'new-ref' )
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

		$response = $concreteRepoGroups -> update ( 149 , 'new-name' , 'new-ref' , 148 ) ;

		$expectedObject = new Group() ;
		$expectedObject -> id = 149 ;
		$expectedObject -> name = 'new-name' ;
		$expectedObject -> parentId = 148 ;
		$expectedObject -> ref = 'new-ref' ;
		$expectedObject -> createdAt = 'the-created-at-timestamp' ;
		$expectedObject -> updatedAt = 'the-updated-at-timestamp' ;

		$this -> assertEquals ( $expectedObject , $response ) ;
	}

	public function test_handlesModelNotFoundException ()
	{
		$eloquentGroup = $this -> mock ( EloquentGroup::class ) ;

		$concreteRepoGroups = new ConcreteRepoGroups ( $eloquentGroup ) ;

		$eloquentGroup
			-> shouldReceive ( 'findOrFail' )
			-> withArgs ( [ 149 ] )
			-> andThrow ( ModelNotFoundException::class )
		;

		$this -> expectException ( RecordNotFoundException::class ) ;

		$concreteRepoGroups -> update ( 149 , 'new-name' , 'new-ref' , 148 ) ;
	}

}
