<?php

$path = base_path ( 'routes/api/*.php' ) ;
$files = glob ( $path ) ;

foreach ( $files as $file )
{
	require_once $file ;
}