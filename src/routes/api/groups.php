<?php

use App\Http\Controllers\Api\ControllerGroups ;
use Illuminate\Routing\Router ;

\Route::group ( [
	'prefix' => 'groups' ,
	] , function(Router $r)
{
	$controller = ControllerGroups::class . '@' ;

	$r -> get ( '' , $controller . 'all' )
		-> name ( 'api.groups.all' ) ;

	$r -> post ( '' , $controller . 'create' )
		-> name ( 'api.groups.create' ) ;

	$r -> get ( '{id}' , $controller . 'one' )
		-> name ( 'api.groups.one' ) ;

	$r -> patch ( '{id}' , $controller . 'update' )
		-> name ( 'api.groups.update' ) ;
} ) ;
