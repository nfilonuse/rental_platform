<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|

Route::group(['prefix' => 'v1', 'middleware' => 'api'], function() {
	Route::post('/password/forgot', 'Api\PasswordController@resetPassword');

	Route::post('/login', 'Api\AuthentificateController@login')->name('api_login');
	Route::post('/signup', 'Api\UserController@create')->name('api_signup');

	Route::group(['middleware' => 'jwt.auth'], function() {
		Route::post('/password/change', 'Api\PasswordController@update');
		Route::get('/practitioner', 'Api\PractitionerController@show')->name('api_get_settings');

		Route::get('/lastappointment', 'Api\AppointmentsController@lastappointment')->name('api_get_lastappointment');

		Route::post('practitioner', 'Api\PractitionerController@update')->name('api_update_settings');

		Route::get('/user', 'Api\UserController@show')->name('api_get_user');
		Route::patch('/user', 'Api\UserController@update')->name('api_update_user');

		Route::post('/user/needle', 'Api\NeedleController@store')->name('api_create_user_needle');
		Route::delete('/user/needle/{id}', 'Api\NeedleController@destroy')->name('api_delete_user_needle');

		Route::post('/sync/client', 'Api\SyncController@client')->name('api_sync_client');
		Route::post('/sync/appointment', 'Api\SyncController@appointment')->name('api_sync_appointment');
		Route::post('/sync/note', 'Api\SyncController@note')->name('api_sync_note');
		Route::post('/sync/pin', 'Api\SyncController@pin')->name('api_sync_pin');
		Route::post('/sync/attachment', 'Api\SyncController@attachment')->name('api_sync_attachment');

		Route::get('/clients', 'Api\ClientsController@index')->name('api_client_list');
		Route::get('/clients/search/{keyword}', 'Api\ClientsController@search')->name('api_clients_search');
		Route::group(['prefix' => 'client'], function() {
			Route::post('/', 'Api\ClientsController@store')->name('api_client_create');
			Route::get('/{id}', 'Api\ClientsController@show')->name('api_client_show');
			Route::post('/{id}', 'Api\ClientsController@update')->name('api_client_update');
			Route::delete('/{id}', 'Api\ClientsController@destroy')->name('api_client_delete');
		});

		Route::get('/client/{client_id}/appointments', 'Api\AppointmentsController@index')->name('api_appointmetns_list');
		Route::group(['prefix' => 'client/{client_id}/appointment'], function() {
			Route::post('/', 'Api\AppointmentsController@store')->name('api_appointmetns_create');
			Route::get('/{id}', 'Api\AppointmentsController@show')->name('api_appointmetns_show');
			Route::patch('/{id}', 'Api\AppointmentsController@update')->name('api_appointmetns_update');
			Route::delete('/{id}', 'Api\AppointmentsController@destroy')->name('api_appointmetns_delete');
		});

		Route::group(['prefix' => 'notes'], function() {
			Route::post('/search', 'Api\NotesController@search')->name('api_notes_search');
		});
		Route::group(['prefix' => 'appointment'], function() {
			Route::get('/{appointment_id}/notes', 'Api\NotesController@index')->name('api_notes_list');
			Route::get('/{appointment_id}/notes/search/{keyword}', 'Api\NotesController@search')->name('api_notes_search');

			Route::group(['prefix' => '{appointment_id}/note'], function() {
				Route::post('/', 'Api\NotesController@store')->name('api_notes_create');
				Route::get('/{id}', 'Api\NotesController@show')->name('api_notes_show');
				Route::post('/{id}', 'Api\NotesController@update')->name('api_notes_update');
				Route::delete('/{id}', 'Api\NotesController@destroy')->name('api_notes_delete');
			});

			Route::get('/{appointment_id}/pins', 'Api\PinsController@index')->name('api_pins_list');
			Route::group(['prefix' => '{appointment_id}/pin'], function() {
				Route::post('/', 'Api\PinsController@store')->name('api_pins_create');
				Route::get('/{id}', 'Api\PinsController@show')->name('api_pins_show');
				Route::post('/{id}', 'Api\PinsController@update')->name('api_pins_update');
				Route::delete('/{id}', 'Api\PinsController@destroy')->name('api_pins_delete');
			});
		});

	});

});

Route::get('rentcar', 'CarController@index')->name('web.rentcar.index');

Route::group(['namespace' => 'Web'], function (\Illuminate\Routing\Router $router) {
    Route::get('/', function () {
        return redirect(route('web.client.index'));
    });

    Route::get('coming-soon', function () { return view('comingSoon'); })->name('comingSoon');

    Route::get('login', 'Auth\AuthController@getLogin')->name('web.login');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@logout')->name('web.logout');

    Route::get('rentcar', 'CarController@index')->name('web.rentcar.index');

    Route::group(['middleware' => 'auth'], function (\Illuminate\Routing\Router $router) {
        Route::get('clients', 'ClientController@index')->name('web.client.index');
        Route::get('clients/new', 'ClientController@create')->name('web.client.create');
        Route::post('clients/new', 'ClientController@store');
    });
});
*/
