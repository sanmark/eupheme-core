<?php

use App\Http\Controllers\Api\ControllerGroups ;
use Illuminate\Routing\Router ;

\Route::group ( [
	'prefix' => 'groups' ,
	] , function(Router $r)
{
	$controller = ControllerGroups::class . '@' ;

	$r -> get ( '' , $controller . 'all' )
		-> name ( 'api.groups.index' ) ;
} ) ;
