<?php

namespace App\Repos\Concretes\Eloquent\Models\Tests ;

use App\Repos\Concretes\Eloquent\Models\Base ;
use stdClass ;
use Tests\TestCase ;

/**
 * @codeCoverageIgnore
 */
class Base_GetUpdatedAtTimestampOrNull_Test extends TestCase
{

	public function test_ok ()
	{
		/* @var $base Base */
		$base = $this -> mock ( Base::class . '[getAttribute]' ) ;
		$updatedAt = $this -> mock ( stdClass::class ) ;

		$base
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'updated_at' ] )
			-> andReturn ( $updatedAt )
		;

		$updatedAt -> timestamp = 149 ;

		$response = $base -> getUpdatedAtTimestampOrNull () ;

		$this -> assertEquals ( 149 , $response ) ;
	}

	public function test_noUpdatedAt ()
	{
		/* @var $base Base */
		$base = $this -> mock ( Base::class . '[getAttribute]' ) ;

		$base
			-> shouldReceive ( 'getAttribute' )
			-> withArgs ( [ 'updated_at' ] )
			-> andReturnNull ()
		;

		$response = $base -> getUpdatedAtTimestampOrNull () ;

		$this -> assertNull ( $response ) ;
	}

}
