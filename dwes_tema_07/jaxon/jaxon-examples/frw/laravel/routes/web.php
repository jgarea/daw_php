<?php

use Jaxon\Laravel\Middleware\AjaxMiddleware;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route to demo page
Route::get('/', 'DemoController@index')->name('demo')->middleware('web');

// Route to Jaxon request processor
Route::post('/ajax', 'DemoController@jaxon')->name('jaxon')->middleware(['web', AjaxMiddleware::class]);
