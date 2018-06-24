<?php

namespace Tests ;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase ;
use Mockery ;

abstract class TestCase extends BaseTestCase
{

	use CreatesApplication ;

	protected function mock ( string $className , array $constructorArgs = NULL )
	{
		if ( is_null ( $constructorArgs ) )
		{
			return Mockery::mock ( $className ) ;
		}

		return Mockery::mock ( $className , $constructorArgs ) ;
	}

	protected function setUp ()
	{
		parent::setUp () ;

		$this -> artisan ( 'migrate' ) ;
	}

	protected function tearDown ()
	{
		$this -> artisan ( 'migrate:reset' ) ;
		parent::tearDown () ;
	}

}
