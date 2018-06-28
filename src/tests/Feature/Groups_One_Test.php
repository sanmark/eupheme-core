<?php

namespace Tests\Feature ;

use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_One_Test extends TestCase
{

	public function test_ok ()
	{
		$this -> seed () ;

		$response = $this -> get ( 'api/groups/1' ) ;

		$response -> assertStatus ( 200 ) ;

		$response -> assertJson ( [
			'data' => [
				'id' => 1 ,
				'name' => 'vehicles' ,
				'parentId' => NULL ,
				'ref' => 'vehicles' ,
				'deletedAt' => NULL ,
			] ,
		] ) ;
	}

}
