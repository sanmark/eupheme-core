<?php

namespace App\Validators\Concretes\Laravel\Validators\Tests ;

use App\Validators\Concretes\Laravel\Validators\ConcreteValidatorGroups ;
use App\Validators\Exceptions\InvalidInputException ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Groups_Update_Test extends TestCase
{

	public function test_ok ()
	{
		$concreteValidatorGroups = new ConcreteValidatorGroups() ;

		$dataAndErrorsCouples = [
			[
				'data' => [] ,
				'errors' => [
					'name' => [
						'required' ,
					] ,
					'ref' => [
						'required' ,
					] ,
				] ,
			] ,
			[
				'data' => [
					'name' => 'the-name' ,
					'parentId' => 'wrong-parentId' ,
					'ref' => 'the-ref' ,
				] ,
				'errors' => [
					'parentId' => [
						'must_be_integer' ,
					] ,
				] ,
			] ,
			[
				'data' => [
					'name' => 'the-name' ,
					'parentId' => 149 ,
					'ref' => 'the-ref' ,
				] ,
				'errors' => [] ,
			] ,
			] ;

		foreach ( $dataAndErrorsCouples as $dataAndErrorsCouple )
		{
			$data = $dataAndErrorsCouple[ 'data' ] ;
			$expectedErrors = $dataAndErrorsCouple[ 'errors' ] ;

			try
			{
				$concreteValidatorGroups -> update ( $data ) ;
			} catch ( InvalidInputException $ex )
			{
				$errors = $ex -> getErrors () ;
				$this -> assertEquals ( $expectedErrors , $errors ) ;
			}
		}
	}

}
