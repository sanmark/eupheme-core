<?php

Route::post ('comments', 'App\Http\Controllers\Api\ControllerComments@create')
    ->name('api.comments.save');

Route::get('ref/{id}', 'App\Http\Controllers\Api\ControllerComments@get')
    ->name('api.comments.get');