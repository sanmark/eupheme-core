<?php

namespace App\Http\Controllers\Api ;

use App\Handlers\HandlerGroups ;
use App\Http\Responses\ErrorResponse ;
use App\Http\Responses\SuccessResponse ;
use App\Repos\Exceptions\RecordNotFoundException ;
use App\Validators\Exceptions\InvalidInputException ;
use Illuminate\Http\Request ;
use Illuminate\Routing\Controller ;

class ControllerGroups extends Controller
{

	private $handlerGroups ;

	public function __construct (
	HandlerGroups $handlerGroups
	)
	{
		$this -> handlerGroups = $handlerGroups ;
	}

	public function all ()
	{
		$groups = $this
			-> handlerGroups
			-> all ()
		;

		$response = new SuccessResponse ( $groups ) ;

		return
				$response
				-> getResponse ()
		;
	}

	public function create ( Request $request )
	{
		try
		{
			$data = $request -> toArray () ;

			$group = $this
				-> handlerGroups
				-> create ( $data )
			;

			$response = new SuccessResponse ( $group , 201 ) ;

			return
					$response
					-> getResponse ()
			;
		} catch ( InvalidInputException $exc )
		{
			$response = new ErrorResponse ( $exc -> getErrors () , 422 ) ;

			return
					$response
					-> getResponse ()
			;
		}
	}

	public function one ( int $id )
	{
		try
		{
			$group = $this
				-> handlerGroups
				-> one ( $id ) ;

			$response = new SuccessResponse ( $group ) ;

			return
					$response
					-> getResponse ()
			;
		} catch ( RecordNotFoundException $exc )
		{
			$response = new ErrorResponse ( NULL , 404 ) ;

			return
					$response
					-> getResponse ()
			;
		}
	}

}
