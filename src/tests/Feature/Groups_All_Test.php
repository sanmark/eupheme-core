<?php

namespace Tests\Feature ;

use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_All_Test extends Base
{

	protected $url = 'api/groups' ;
	protected $httpVerb = 'get' ;

	public function test_ok ()
	{
		$this -> seed () ;

		$response = $this -> getWithValidAppKeyAndSecretHash ( 'api/groups' ) ;

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
