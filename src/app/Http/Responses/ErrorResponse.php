<?php

namespace App\Http\Responses ;

class ErrorResponse
{

	private $errors ;
	private $statusCode ;

	public function __construct ( $errors , $statusCode = 200 )
	{
		$this -> errors = $errors ;
		$this -> statusCode = $statusCode ;
	}
	
	public function getResponse ()
	{
		return
				response ()
				-> json ( [
					'errors' => $this -> errors ,
				] )
				-> setStatusCode ( $this -> statusCode )
		;
	}

}
