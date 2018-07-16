<?php

$path = base_path('routes/api/*.php');
$files = glob($path);

foreach ($files as $file) {
    if (app() -> environment('testing')) {
        require $file;
    } else {
        require_once $file;
    }
}

Route::post ('comments', 'App\Http\Controllers\Api\ControllerComments@create')
    ->name('api.comments.save');