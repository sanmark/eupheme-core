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
class Groups_One_Test extends TestCase
{

	public function test_ok ()
	{
		$eloquentGroup = $this -> mock ( EloquentGroup::class ) ;

		$eloquentGroup
			-> shouldReceive ( 'findOrFail' )
			-> withArgs ( [ 149 ] )
			-> andReturnSelf ()
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
			-> shouldReceive ( 'getDeletedAtTimestampOrNull' )
			-> withNoArgs ()
			-> andReturn ( 'the-deleted_at-timestamp' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getCreatedAtTimestampOrNull' )
			-> withNoArgs ()
			-> andReturn ( 'the-created_at-timestamp' )
		;

		$eloquentGroup
			-> shouldReceive ( 'getUpdatedAtTimestampOrNull' )
			-> withNoArgs ()
			-> andReturn ( 'the-updated_at-timestamp' )
		;

		/* @var $concreteRepoGroups ConcreteRepoGroups */
		$concreteRepoGroups = new ConcreteRepoGroups ( $eloquentGroup ) ;

		$response = $concreteRepoGroups -> one ( 149 ) ;

		$expectedObject = new Group() ;
		$expectedObject -> id = 'the-id' ;
		$expectedObject -> name = 'the-name' ;
		$expectedObject -> parentId = 'the-parent_id' ;
		$expectedObject -> ref = 'the-ref' ;
		$expectedObject -> deletedAt = 'the-deleted_at-timestamp' ;
		$expectedObject -> createdAt = 'the-created_at-timestamp' ;
		$expectedObject -> updatedAt = 'the-updated_at-timestamp' ;

		$this -> assertEquals ( $expectedObject , $response ) ;
	}

	public function test_handlesModelNotFoundException ()
	{
		$eloquentGroup = $this -> mock ( EloquentGroup::class ) ;

		/* @var $concreteRepoGroups ConcreteRepoGroups */
		$concreteRepoGroups = new ConcreteRepoGroups ( $eloquentGroup ) ;

		$eloquentGroup
			-> shouldReceive ( 'findOrFail' )
			-> withArgs ( [ 149 ] )
			-> andThrow ( ModelNotFoundException::class )
		;

		$this -> expectException ( RecordNotFoundException::class ) ;

		$concreteRepoGroups -> one ( 149 ) ;
	}

}