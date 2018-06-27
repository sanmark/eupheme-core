<?php

namespace Tests\Feature ;

use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_All_Test extends TestCase
{

	public function test_ok ()
	{
		$this -> seed () ;

		$response = $this -> get ( 'api/groups' ) ;

		$response -> assertStatus ( 200 ) ;

		$response -> assertJson ( [
			'data' => [
				[
					'id' => 1 ,
					'name' => 'vehicles' ,
					'parentId' => NULL ,
					'ref' => 'vehicles' ,
					'deletedAt' => NULL ,
				] ,
				[
					'id' => 2 ,
					'name' => 'vacancies' ,
					'parentId' => NULL ,
					'ref' => 'vacancies' ,
					'deletedAt' => NULL ,
				] ,
			] ,
			] , TRUE ) ;
	}

}
