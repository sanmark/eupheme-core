<?php

namespace App\Http\Controllers\Api ;

use App\Handlers\HandlerGroups ;
use App\Http\Responses\SuccessResponse ;
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

}
