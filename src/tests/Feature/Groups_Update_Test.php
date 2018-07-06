<?php

namespace Tests\Feature ;

use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_Update_Test extends TestCase
{

	public function test_ok ()
	{
		$this -> seed () ;

		$response = $this -> patch ( 'api/groups/1' , [
			'name' => 'the-new-name' ,
			'parentId' => 149 ,
			'ref' => 'the-new-ref' ,
			] ) ;

		$response -> assertStatus ( 200 ) ;

		$response -> assertJson ( [
			'data' => [
				'id' => 1 ,
				'name' => 'the-new-name' ,
				'parentId' => 149 ,
				'ref' => 'the-new-ref' ,
				'deletedAt' => NULL ,
			] ,
		] ) ;
	}

	public function test_invalidId ()
	{
		$this -> seed () ;

		$response = $this -> patch ( 'api/groups/3' , [
			'name' => 'the-new-name' ,
			'parentId' => 149 ,
			'ref' => 'the-new-ref' ,
			] ) ;

		$response -> assertStatus ( 404 ) ;

		$response -> assertJson ( [ 'errors' => [] ] ) ;
	}

	public function test_throwsErrorOnInvalidInput ()
	{
		$this -> seed () ;

		$response = $this -> patch ( 'api/groups/1' ) ;

		$response -> assertStatus ( 422 ) ;

		$response -> assertJson ( [
			'errors' => [
				'name' => [
					'required' ,
				] ,
				'ref' => [
					'required' ,
				] ,
			] ,
		] ) ;
	}

}
