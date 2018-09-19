<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('/search/location', 'HertzApi\Http\Controllers\API\SearchController@locations');
    $api->post('/search/ratecode', 'HertzApi\Http\Controllers\API\SearchController@ratecode');
    $api->post('/search/states', 'HertzApi\Http\Controllers\API\SearchController@getstates');
//    $api->post('/locations', 'HertzApi\Http\Controllers\Admin\LocationsController@getdata');
    //$api->get('/tblrates', 'HertzApi\Http\Controllers\Admin\RatesController@getrates');
    //$api->get('/tbllocations', 'HertzApi\Http\Controllers\Admin\LocationsController@getlocations');
    $api->get('/tblrates', 'HertzApi\Http\Controllers\API\SearchController@getrates');
    $api->get('/tbllocations', 'HertzApi\Http\Controllers\API\SearchController@getlocations');
    $api->get('/report1', 'HertzApi\Http\Controllers\API\SearchController@getreports1');
    $api->get('/report2', 'HertzApi\Http\Controllers\API\SearchController@getreports2');

    $api->post('/search/cars', 'HertzApi\Http\Controllers\API\SearchController@getcars');

    $api->post('/paymant/success', function () { return response('', 200)->header('Content-Type', 'application/json'); });
    $api->post('/paymant/cancel', function () { return response('', 200)->header('Content-Type', 'application/json'); });

        
});
