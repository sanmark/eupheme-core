<?php

namespace Tests\Feature ;

use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_Create_Test extends TestCase
{

	public function test_ok ()
	{
		$response = $this -> post ( 'api/groups' , [
			'name' => 'the-name' ,
			'parentId' => 149 ,
			'ref' => 'the-ref' ,
			] ) ;

		$response -> assertStatus ( 201 ) ;
		$response -> assertJson ( [
			'data' => [
				'id' => 1 ,
				'name' => 'the-name' ,
				'parentId' => 149 ,
				'ref' => 'the-ref' ,
			] ,
		] ) ;
	}

	public function test_throwsErrorOnInvalidInput ()
	{
		$response = $this -> post ( 'api/groups' ) ;

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
